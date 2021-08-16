<?php

namespace App\Controllers;

use \App\Models\Serversidemodeljoin;
use App\Models\M_master;


class ListDataPerizinan extends BaseController
{
	public function __construct()
	{
		$this->m_master = new m_master();
	}

	public function index()
	{
		$session = session();
		if ($session->is_login == True) {
			$data['judul'] = "List Data Perizinan";
			$data['data'] = $this->m_master->getall('tblm_jenisizin', 'namaJenis');
			// print_r($data['data']);
			return view('list/index', $data);
		} else {
			return redirect()->to('/login');
		}
	}
	public function index1()
	{
		$session = session();
		if ($session->is_login == True) {
			$data['judul'] = "List Data Perizinan";
			$data['data'] = $this->m_master->getall('tblm_jenisizin', 'namaJenis');
			// print_r($data['data']);
			return view('list/index1', $data);
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
			// 'jenisId' => $this->request->getVar('perizinan'),
			'noPerizinan'  => $this->request->getVar('noperizinan'),
			'namaP'  => $this->request->getVar('namap'),
			'tdeskripsi'  => $this->request->getVar('deskripsi'),
			'tanggalAktif'  => $this->request->getVar('tglaktif'),
			'tanggalBerlaku'  => $this->request->getVar('tglberlaku'),
			'instansi'  => $this->request->getVar('instansi'),
			'alamat'  => $this->request->getVar('alamat'),
			'catatan'  => $this->request->getVar('catatan'),
			'update_at'  => $date,
		];

		$builder->where('idPerizinan', $this->request->getVar('perizinanid'));
		$save = $builder->update($data);
		$data = [
			'success' => true,
			'data' => $data,
			'id' => $this->request->getVar('perizinanid'),
			'msg' => "Berhasil mengubah data"
		];

		return $this->response->setJSON($data);
	}
	public function ajax_list()
	{
		$request = \Config\Services::request();
		$model = new Serversidemodeljoin();
		$where = array('tblt_perizinan.is_active' => '1', 'tanggalBerlaku >=' => date('Y-m-d'));

		$column_order = array('idPerizinan', 'jenisId', 'noPerizinan', 'noPengesahan', 'namaP', 'tdeskripsi', 'tanggalAktif', 'tanggalBerlaku', 'instansi', 'alamat', 'catatan', 'c');
		$column_search = array('noPerizinan', 'noPengesahan', 'namaP', 'tdeskripsi', 'tanggalAktif', 'tanggalBerlaku', 'instansi', 'alamat', 'namaJenis');
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
			$row[] = '<div class="float-right"><a href="javascript:void(0)" data-perizinan_tanggalberlaku="' . $key->tanggalBerlaku . '" data-perizinan_tanggalaktif="' . $key->tanggalAktif . '" data-perizinan_alamat="' . $key->alamat . '" data-perizinan_instansi="' . $key->instansi . '" data-perizinan_tdeskripsi="' . $key->tdeskripsi . '" data-perizinan_noperizinan="' . $key->noPerizinan . '" data-perizinan_namap="' . $key->namaP . '" data-perizinan_namajenis="' . $key->namaJenis . '"class="mr-2 item_edit" style="color: black;" data-perizinan_id="' . $key->idPerizinan . '" data-perizinan_jenisid="' . $key->jenisId . '" data-perizinan_noperizinan="' . $key->noPerizinan . '" data-perizinan_notes="' . $key->catatan . '" style="font-size:12px;"><i class="fa fa-pencil"></i></a>        <a class="mr-2" style="color: black;" href="javascript:void(0)" title="Destroy" onclick="delete_data(' . "'" . $key->idPerizinan . "'" . ')" style="font-size:12px;" ><i class="fa fa-trash"></i></a></div>';
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
	public function ajax_list1()
	{
		$request = \Config\Services::request();
		$model = new Serversidemodeljoin();
		$where = array('tblt_perizinan.is_active' => '1', 'tanggalBerlaku >=' => date('Y-m-d'));

		$column_order = array('idPerizinan', 'jenisId', 'noPerizinan', 'noPengesahan', 'namaP', 'tdeskripsi', 'tanggalAktif', 'tanggalBerlaku', 'instansi', 'alamat', 'catatan', 'namaJenis');
		$column_search = array('noPerizinan', 'noPengesahan', 'namaP', 'tdeskripsi', 'tanggalAktif', 'tanggalBerlaku', 'instansi', 'alamat');
		$order = array('idPerizinan' => 'DESC');
		$listing = $model->get_datatables('tblt_perizinan', $column_order, $column_search, $order, $where);
		$data = array();
		$no = $request->getPost("start");

		// foreach ($listing as $key) {
		// 	$no++;
		// 	$row = array();
		// 	$row[] = $no;
		// 	$row[] = $key->namaJenis;
		// 	$row[] = $no;
		// 	$row[] = $key->namaP;
		// 	$row[] = $key->noPerizinan;
		// 	$row[] = $key->tdeskripsi;
		// 	$row[] = $key->instansi;
		// 	$row[] = $key->alamat;
		// 	$row[] = $key->tanggalAktif;
		// 	$row[] = $key->tanggalBerlaku;
		// 	$row[] = '<div class="float-right"><a href="javascript:void(0)" data-perizinan_tanggalberlaku="' . $key->tanggalBerlaku . '" data-perizinan_tanggalaktif="' . $key->tanggalAktif . '" data-perizinan_alamat="' . $key->alamat . '" data-perizinan_instansi="' . $key->instansi . '" data-perizinan_tdeskripsi="' . $key->tdeskripsi . '" data-perizinan_noperizinan="' . $key->noPerizinan . '" data-perizinan_namap="' . $key->namaP . '" data-perizinan_namajenis="' . $key->namaJenis . '"class="mr-2 item_edit" style="color: black;" data-perizinan_id="' . $key->idPerizinan . '" data-perizinan_jenisid="' . $key->jenisId . '" data-perizinan_noperizinan="' . $key->noPerizinan . '" data-perizinan_notes="' . $key->catatan . '" style="font-size:12px;"><i class="fa fa-pencil"></i></a>        <a class="mr-2" style="color: black;" href="javascript:void(0)" title="Destroy" onclick="delete_data(' . "'" . $key->idPerizinan . "'" . ')" style="font-size:12px;" ><i class="fa fa-trash"></i></a></div>';
		// 	$data[] = $row;
		// }

		$output = array(
			"draw" => $request->getPost("draw"),
			"recordsTotal" => $model->jumlah_semua('tblt_perizinan', $where),
			"recordsFiltered" => $model->jumlah_filter('tblt_perizinan', $column_order, $column_search, $order, $where),
			"data" => $listing
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
}
