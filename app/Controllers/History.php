<?php

namespace App\Controllers;

// use \App\Models\Serversidemodel;
use \App\Models\Serversidemodeljoin;
use \App\Models\HistoryAlat;
use App\Models\M_master;


class History extends BaseController
{
	public function __construct()
	{
		$this->m_master = new m_master();
	}

	public function index()
	{
		$session = session();
		if ($session->is_login == True) {
			$data['judul'] = "History Data Perizinan";
			$data['data'] = $this->m_master->getall('tblm_jenisizin', 'namaJenis');
			return view('history/index', $data);
		} else {
			return redirect()->to('/login');
		}
	}
	public function ajax_list()
	{
		$request = \Config\Services::request();
		$model = new Serversidemodeljoin();
		$where = array('tblt_perizinan.is_active' => '1', 'tanggalBerlaku <=' => date('Y-m-d'));

		$column_order = array('idPerizinan', 'jenisId', 'noPerizinan', 'noPengesahan', 'namaP', 'tdeskripsi', 'tanggalAktif', 'tanggalBerlaku', 'instansi', 'alamat', 'catatan', 'namaJenis');
		$column_search = array('noPerizinan', 'noPengesahan', 'namaP', 'tdeskripsi', 'tanggalAktif', 'tanggalBerlaku', 'instansi', 'alamat');
		$order = array('idPerizinan' => 'DESC');
		$listing = $model->get_datatables('tblt_perizinan', $column_order, $column_search, $order, $where);
		$data = array();
		$no = $request->getPost("start");


		foreach ($listing as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $key->namaJenis;
			$row[] = $no;
			$row[] = $key->namaP;
			$row[] = $key->noPerizinan;
			$row[] = $key->tdeskripsi;
			$row[] = $key->instansi;
			$row[] = $key->alamat;
			$row[] = $key->tanggalAktif;
			$row[] = $key->tanggalBerlaku;
			$row[] = '<div class="float-right"><a href="javascript:void(0)" data-perizinan_tanggalberlaku="' . $key->tanggalBerlaku . '" data-perizinan_tanggalaktif="' . $key->tanggalAktif . '" data-perizinan_alamat="' . $key->alamat . '" data-perizinan_instansi="' . $key->instansi . '" data-perizinan_tdeskripsi="' . $key->tdeskripsi . '" data-perizinan_noperizinan="' . $key->noPerizinan . '" data-perizinan_namap="' . $key->namaP . '" data-perizinan_namajenis="' . $key->namaJenis . '"class="mr-2 item_edit" style="color: black;" data-perizinan_id="' . $key->idPerizinan . '" data-perizinan_jenisid="' . $key->jenisId . '" data-perizinan_noperizinan="' . $key->noPerizinan . '" style="font-size:12px;"><i class="fa fa-pencil"></i></a><a class="mr-2" style="color: black;" href="javascript:void(0)" title="Destroy" onclick="delete_data(' . "'" . $key->idPerizinan . "'" . ')" style="font-size:12px;" ><i class="fa fa-trash"></i></a></div>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $request->getPost("draw"),
			"recordsTotal" => $model->jumlah_semua('tblt_perizinan', $where),
			"recordsFiltered" => $model->jumlah_filter('tblt_perizinan', $column_order, $column_search, $order, $where),
			"data" => $data
		);
		echo json_encode($output);
	}
	public function delete_izin($id)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('tblt_perizinan');

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

	// peralatan 
	public function alat()
	{
		$session = session();
		if ($session->is_login == True) {
			$data['judul'] = "History Data Peralatan";
			$data['data'] = $this->m_master->getall('tblm_jenisizin', 'namaJenis');
			return view('history/alat', $data);
		} else {
			return redirect()->to('/login');
		}
	}
	public function ajax_alat()
	{
		$request = \Config\Services::request();
		$model = new HistoryAlat();
		$where = array('tblt_peralatan.is_active' => '1');

		$column_order = array('idtrPeralatan', 'peralatanId', 'noUrutDokumen', 'noDokumen', 'noPengesahan', 'kapasitas', 'lokasiId', 'tanggalDikeluarkan', 'tanggalBerlaku', 'periodePerpanjangan', 'keteranganPeralatan', 'namaPeralatan', 'nama');
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
			// $row[] = '<div class="float-right"><a href="javascript:void(0)"  style="font-size:12px;"><i class="fa fa-pencil"></i></a><a class="mr-2" style="color: black;" href="javascript:void(0)" title="Destroy" onclick="delete_data(' . "'" . $key->idPerizinan . "'" . ')" style="font-size:12px;" ><i class="fa fa-trash"></i></a></div>';
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
	public function delete_alat($id)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('tblt_perizinan');

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
