<?php

namespace App\Controllers;

use \App\Models\Serversidemodel;
use \App\Models\Modelmaster;
use App\Models\M_master;


class Master extends BaseController
{
	public function __construct()
	{
		$this->Lokasitblm = new Serversidemodel();
		$this->Modelmaster = new Modelmaster();
		$this->m_master = new m_master();
	}
	// peralatan 
	public function index()
	{
		$session = session();
		if ($session->is_login == True) {
			$data['judul'] = "Master Data Peralatan";
			$data['lokasi'] = $this->m_master->getall('tblm_lokasi', 'nama');

			return view('master/peralatan', $data);
		} else {
			return redirect()->to('/login');
		}
	}
	public function ajax_editalat()
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('tblm_peralatan');
		$date = date('Y-m-d H:i:s');
		$data = [
			'namaPeralatan' => $this->request->getVar('peralatan_nama'),
			'detailPeralatan'  => $this->request->getVar('peralatan_detail'),
			'update_at'  => $date,
		];

		$builder->where('idPeralatan', $this->request->getVar('peralatan_id'));
		$save = $builder->update($data);
		$data = [
			'success' => true,
			'data' => $save,
			'msg' => "Berhasil menambah data"
		];

		return $this->response->setJSON($data);
	}
	public function alat_list()
	{
		$request = \Config\Services::request();
		$model = new Serversidemodel();
		$where = array('is_active' => '1');

		$column_order = array('idPeralatan', 'namaPeralatan', 'detailPeralatan');
		$column_search = array('namaPeralatan', 'detailPeralatan');
		$order = array('idPeralatan' => 'DESC');
		$listing = $model->get_datatables('tblm_peralatan', $column_order, $column_search, $order, $where);
		$data = array();
		$no = $request->getPost("start");


		foreach ($listing as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $key->timestamp;
			$row[] = $key->namaPeralatan;
			$row[] = $key->detailPeralatan;
			$row[] = '<div class="float-right"><a href="javascript:void(0)" class="mr-2 item_edit" style="color: black;" data-peralatan_id="' . $key->idPeralatan . '" data-peralatan_nama="' . $key->namaPeralatan . '" data-peralatan_detail="' . $key->detailPeralatan . '" style="font-size:12px;"><i class="fa fa-pencil"></i></a><a class="mr-2" style="color: black;" href="javascript:void(0)" title="Destroy" onclick="delete_data(' . "'" . $key->idPeralatan . "'" . ')" style="font-size:12px;" ><i class="fa fa-trash"></i></a></div>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $request->getPost("draw"),
			"recordsTotal" => $model->jumlah_semua('tblm_peralatan', $where),
			"recordsFiltered" => $model->jumlah_filter('tblm_peralatan', $column_order, $column_search, $order, $where),
			"data" => $data
		);
		echo json_encode($output);
	}

	public function t_alat()
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('tblm_peralatan');

		$data = [

			'namaPeralatan' => $this->request->getVar('namaPeralatan'),
			'detailPeralatan'  => $this->request->getVar('detail'),
			'created_by'  => session('nama_lengkap'),
		];

		$save = $builder->insert($data);

		$data = [
			'success' => true,
			'data' => $save,
			'msg' => "Berhasil menambah data"
		];

		return $this->response->setJSON($data);
	}
	public function delete_alat($id)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('tblm_peralatan');

		$data = [
			'is_active' => 0,
			// 'is_delete'  => '1',
		];
		$idne = [
			'idPeralatan' => $id
		];
		$builder->update($data, $idne);
		echo json_encode(array("status" => TRUE));
	}

	// lokasi 
	public function ajax_list()
	{
		$request = \Config\Services::request();
		$model = new Serversidemodel();
		$where = array('is_active' => '1');

		$column_order = array('idLokasi', 'timestamp', 'nama', 'detail');
		$column_search = array('nama', 'detail');
		$order = array('idLokasi' => 'DESC');
		$listing = $model->get_datatables('tblm_lokasi', $column_order, $column_search, $order, $where);
		$data = array();
		$no = $request->getPost("start");


		foreach ($listing as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $key->timestamp;
			$row[] = $key->nama;
			$row[] = $key->detail;
			$row[] = '<div class="float-right"><a href="javascript:void(0)" class="mr-2 item_edit" style="color: black;" data-lokasi_id="' . $key->idLokasi . '" data-lokasi_nama="' . $key->nama . '" data-lokasi_detail="' . $key->detail . '" style="font-size:12px;"><i class="fa fa-pencil"></i></a><a class="mr-2" style="color: black;" href="javascript:void(0)" title="Hapus" onclick="delete_data(' . "'" . $key->idLokasi . "'" . ')" style="font-size:12px;" ><i class="fa fa-trash"></i></a></div>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $request->getPost("draw"),
			"recordsTotal" => $model->jumlah_semua('tblm_lokasi', $where),
			"recordsFiltered" => $model->jumlah_filter('tblm_lokasi', $column_order, $column_search, $order, $where),
			"data" => $data
		);
		echo json_encode($output);
	}

	// lokasi 
	public function lokasi()
	{
		$session = session();
		if ($session->is_login == True) {
			$data['judul'] = "Master Data Lokasi";
			return view('master/lokasi', $data);
		} else {
			return redirect()->to('/login');
		}
	}
	public function ajax_editlokasi()
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('tblm_lokasi');
		$date = date('Y-m-d H:i:s');
		$data = [
			'nama' => $this->request->getVar('lokasi_nama'),
			'detail'  => $this->request->getVar('lokasi_detail'),
			'update_at'  => $date,
		];

		$builder->where('idLokasi', $this->request->getVar('lokasi_id'));
		$save = $builder->update($data);
		$data = [
			'success' => true,
			'data' => $save,
			'msg' => "Berhasil menambah data"
		];

		return $this->response->setJSON($data);
	}
	public function ajax_delete($id)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('tblm_lokasi');

		$data = [
			'is_active' => 0,
			// 'is_delete'  => '1',
		];
		$idne = [
			'idLokasi' => $id
		];
		$builder->update($data, $idne);
		echo json_encode(array("status" => TRUE));
	}

	public function tl_lokasi()
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('tblm_lokasi');

		$data = [

			'nama' => $this->request->getVar('nama'),
			'detail'  => $this->request->getVar('detail'),
		];

		$save = $builder->insert($data);

		$data = [
			'success' => true,
			'data' => $save,
			'msg' => "Berhasil menambah data"
		];

		return $this->response->setJSON($data);
	}

	// izin 
	public function izin()
	{
		$session = session();
		if ($session->is_login == True) {
			$data['judul'] = "Master Data Izin";
			return view('master/izin', $data);
		} else {
			return redirect()->to('/login');
		}
	}
	public function ajax_editizin()
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('tblm_jenisizin');
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
	public function ajax_izin()
	{
		$request = \Config\Services::request();
		$model = new Serversidemodel();
		$where = array('is_active' => '1');

		$column_order = array('idJenisIzin', 'timestamp', 'nama', 'deskripsi');
		$column_search = array('nama', 'deskripsi');
		$order = array('idJenisIzin' => 'DESC');
		$listing = $model->get_datatables('tblm_jenisizin', $column_order, $column_search, $order, $where);
		$data = array();
		$no = $request->getPost("start");
		foreach ($listing as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $key->timestamp;
			$row[] = $key->namaJenis;
			$row[] = $key->deskripsi;
			$row[] = '<div class="float-right"><a href="javascript:void(0)" class="mr-2 item_edit" style="color: black;" data-jenis_id="' . $key->idJenisIzin . '" data-jenis_nama="' . $key->namaJenis . '" data-jenis_deskripsi="' . $key->deskripsi . '" style="font-size:12px;"><i class="fa fa-pencil"></i></a><a class="mr-2" style="color: black;" href="javascript:void(0)" title="Destroy" onclick="delete_data(' . "'" . $key->idJenisIzin . "'" . ')" style="font-size:12px;" ><i class="fa fa-trash"></i></a></div>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $request->getPost("draw"),
			"recordsTotal" => $model->jumlah_semua('tblm_jenisizin', $where),
			"recordsFiltered" => $model->jumlah_filter('tblm_jenisizin', $column_order, $column_search, $order, $where),
			"data" => $data
		);
		echo json_encode($output);
	}
	public function t_izin()
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('tblm_jenisizin');

		$data = [

			'namaJenis' => $this->request->getVar('nama'),
			'deskripsi'  => $this->request->getVar('deskripsi'),
		];

		$save = $builder->insert($data);

		$data = [
			'success' => true,
			'data' => $save,
			'msg' => "Berhasil menambah data"
		];

		return $this->response->setJSON($data);
	}
	public function delete_izin($id)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('tblm_jenisizin');

		$data = [
			'is_active' => 0,
			// 'is_delete'  => '1',
		];
		$idne = [
			'idJenisIzin' => $id
		];
		$builder->update($data, $idne);
		echo json_encode(array("status" => TRUE));
	}

	// Kategori
	public function kategori()
	{
		$session = session();
		if ($session->is_login == True) {
			$data['judul'] = "Kategori";
			return view('master/kategori', $data);
		} else {
			return redirect()->to('/login');
		}
	}
	public function ajax_editkat()
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('tblm_kategori');
		$date = date('Y-m-d H:i:s');
		$data = [
			'namaKategori' => $this->request->getVar('kategori_nama'),
			// 'detailPeralatan'  => $this->request->getVar('peralatan_detail'),
			'update_at'  => $date,
		];

		$builder->where('idKategori', $this->request->getVar('kategori_id'));
		$save = $builder->update($data);
		$data = [
			'success' => true,
			'data' => $save,
			'msg' => "Berhasil mengubah data"
		];

		return $this->response->setJSON($data);
	}
	public function ajax_kategori()
	{
		$request = \Config\Services::request();
		$model = new Serversidemodel();
		$where = array('is_active' => '1');

		$column_order = array('timestamp', 'namaKategori');
		$column_search = array('namaKategori');
		$order = array('idKategori' => 'DESC');
		$listing = $model->get_datatables('tblm_kategori', $column_order, $column_search, $order, $where);
		$data = array();
		$no = $request->getPost("start");
		foreach ($listing as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $key->timestamp;
			$row[] = $key->namaKategori;
			$row[] = '<div class="float-right"><a href="javascript:void(0)" class="mr-2 item_edit" style="color: black;" data-kategori_id="' . $key->idKategori . '" data-kategori_nama="' . $key->namaKategori . '" style="font-size:12px;"><i class="fa fa-pencil"></i></a><a class="mr-2" style="color: black;" href="javascript:void(0)" title="Hapus" onclick="delete_data(' . "'" . $key->idKategori . "'" . ')" style="font-size:12px;" ><i class="fa fa-trash"></i></a></div>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $request->getPost("draw"),
			"recordsTotal" => $model->jumlah_semua('tblm_kategori', $where),
			"recordsFiltered" => $model->jumlah_filter('tblm_kategori', $column_order, $column_search, $order, $where),
			"data" => $data
		);
		echo json_encode($output);
	}
	public function t_kat()
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('tblm_kategori');

		$data = [

			'namaKategori' => $this->request->getVar('nama'),
		];

		$save = $builder->insert($data);

		$data = [
			'success' => true,
			'data' => $save,
			'msg' => "Berhasil menambah data"
		];

		return $this->response->setJSON($data);
	}
	public function delete_kat($id)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('tblm_kategori');

		$data = [
			'is_active' => 0,
			// 'is_delete'  => '1',
		];
		$idne = [
			'idKategori' => $id
		];
		$builder->update($data, $idne);
		echo json_encode(array("status" => TRUE));
	}


	// Jenis peraturan 
	public function jenisperaturan()
	{
		$session = session();
		if ($session->is_login == True) {
			$data['judul'] = "Master Data Jenis Peraturan";
			return view('master/jenisperaturan', $data);
		} else {
			return redirect()->to('/login');
		}
	}
	public function ajax_editjenisperaturan()
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('tblm_jenisidentifikasi');
		$date = date('Y-m-d H:i:s');
		$data = [
			'nama' => $this->request->getVar('jenis_nama'),
			'deskripsi'  => $this->request->getVar('jenis_deskripsi'),
			'update_at'  => $date,
		];

		$builder->where('idJenisIdentifikasi', $this->request->getVar('jenis_id'));
		$save = $builder->update($data);
		$data = [
			'success' => true,
			'data' => $save,
			'msg' => "Berhasil menambah data"
		];

		return $this->response->setJSON($data);
	}
	public function ajax_jenisperaturan()
	{
		$request = \Config\Services::request();
		$model = new Serversidemodel();
		$where = array('is_active' => '1');

		$column_order = array('idJenisIdentifikasi', 'timestamp', 'nama', 'deskripsi');
		$column_search = array('nama', 'deskripsi');
		$order = array('idJenisIdentifikasi' => 'DESC');
		$listing = $model->get_datatables('tblm_jenisidentifikasi', $column_order, $column_search, $order, $where);
		$data = array();
		$no = $request->getPost("start");
		foreach ($listing as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $key->timestamp;
			$row[] = $key->nama;
			$row[] = $key->deskripsi;
			$row[] = '<div class="float-right"><a href="javascript:void(0)" class="mr-2 item_edit" style="color: black;" data-jenis_id="' . $key->idJenisIdentifikasi . '" data-jenis_nama="' . $key->nama . '" data-jenis_deskripsi="' . $key->deskripsi . '" style="font-size:12px;"><i class="fa fa-pencil"></i></a><a class="mr-2" style="color: black;" href="javascript:void(0)" title="Destroy" onclick="delete_data(' . "'" . $key->idJenisIdentifikasi . "'" . ')" style="font-size:12px;" ><i class="fa fa-trash"></i></a></div>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $request->getPost("draw"),
			"recordsTotal" => $model->jumlah_semua('tblm_jenisidentifikasi', $where),
			"recordsFiltered" => $model->jumlah_filter('tblm_jenisidentifikasi', $column_order, $column_search, $order, $where),
			"data" => $data
		);
		echo json_encode($output);
	}
	public function t_jenisperaturan()
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('tblm_jenisidentifikasi');

		$data = [

			'nama' => $this->request->getVar('nama'),
			'deskripsi'  => $this->request->getVar('deskripsi'),
		];

		$save = $builder->insert($data);

		$data = [
			'success' => true,
			'data' => $save,
			'msg' => "Berhasil menambah data"
		];

		return $this->response->setJSON($data);
	}
	public function delete_jenisperaturan($id)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('tblm_jenisidentifikasi');

		$data = [
			'is_active' => 0,
			// 'is_delete'  => '1',
		];
		$idne = [
			'idJenisIdentifikasi' => $id
		];
		$builder->update($data, $idne);
		echo json_encode(array("status" => TRUE));
	}
}
