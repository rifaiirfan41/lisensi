<?php

namespace App\Controllers;

use \App\Models\Serversidemodeljoin;
use App\Models\M_master;
use App\Models\HistoryAlat;


class ListDataPeralatan extends BaseController
{
	public function __construct()
	{
		$this->m_master = new m_master();
	}

	public function index()
	{
		$session = session();
		if ($session->is_login == True) {
			$data['judul'] = "List Data Peralatan";
			$data['data'] = $this->m_master->getall('tblm_jenisizin', 'namaJenis');
			return view('list/alat', $data);
		} else {
			return redirect()->to('/login');
		}
	}
	public function ajax_editizin()
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('tblt_perizinan');
		$date = date('Y-m-d H:i:s');
		$data = [
			'namaJenis' => $this->request->getVar('jenis_nama'),
			'deskripsi'  => $this->request->getVar('jenis_deskripsi'),
			'update_at'  => $date,
		];

		$builder->where('idJenisIzin', $this->request->getVar('jenis_id'));
		$save = $builder->update($data);
		$data = [
			'success' => true,
			'data' => $save,
			'msg' => "Berhasil menambah data"
		];

		return $this->response->setJSON($data);
	}
	public function ajax_list()
	{
		$request = \Config\Services::request();
		$model = new HistoryAlat();
		$where = array('tblt_peralatan.is_active' => '1', 'tanggalBerlaku >=' => date('Y-m-d'));

		$column_order = array('idtrPeralatan', 'peralatanId', 'noUrutDokumen', 'noDokumen', 'noPengesahan', 'kapasitas', 'lokasiId', 'tanggalDikeluarkan', 'tanggalBerlaku', 'periodePerpanjangan', 'keteranganPeralatan', 'tblm_peralatan.namaPeralatan', 'tblm_lokasi.nama');
		$column_search = array('noDokumen', 'noPengesahan', 'noUrutDokumen', 'kapasitas', 'lokasiId', 'tanggalDikeluarkan', 'tanggalBerlaku', 'periodePerpanjangan', 'keteranganPeralatan', 'namaPeralatan', 'nama');
		$order = array('noUrutDokumen' => 'ASC');
		$listing = $model->get_datatables('tblt_peralatan', $column_order, $column_search, $order, $where);
		$data = array();
		$no = $request->getPost("start");


		foreach ($listing as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $key->noUrutDokumen;
			$row[] = $key->noDokumen;
			$row[] = $key->noPengesahan;
			$row[] = $key->namaPeralatan;
			$row[] = $key->kapasitas;
			$row[] = $key->nama;
			$row[] = $key->tanggalDikeluarkan;
			$row[] = $key->tanggalBerlaku;
			$row[] = $key->periodePerpanjangan;
			$row[] = '<div class="float-right"><a href="javascript:void(0)"  style="font-size:12px;"><i class="fa fa-pencil"></i></a><a class="mr-2" style="color: black;" href="javascript:void(0)" title="Destroy" onclick="delete_data(' . "'" . $key->idtrPeralatan . "'" . ')" style="font-size:12px;" ><i class="fa fa-trash"></i></a></div>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $request->getPost("draw"),
			"recordsTotal" => $model->jumlah_semua('tblt_peralatan', $where),
			"recordsFiltered" => $model->jumlah_filter('tblt_peralatan', $column_order, $column_search, $order, $where),
			"data" => $data
		);
		echo json_encode($output);
	}
	public function delete_izin($id)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('tblt_peralatan');

		$data = [
			'is_active' => 0,
			// 'is_delete'  => '1',
		];
		$idne = [
			'idPerizinan' => $id
		];
		$builder->update($data, $idne);
		echo json_encode(array("status" => TRUE));
	}
}
