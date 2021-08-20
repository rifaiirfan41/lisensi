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
	public function upload_file()
	{
		$config['upload_path']          = 'uploads/';
		$config['allowed_types']        = 'pdf|jpg|png|tif|tiff';
		$config['encrypt_name']         = FALSE;
		$this->load->library('upload', $config);

		$data = [];

		$count = count($_FILES);
		for ($i = 0; $i < $count; $i++) {
			if (!empty($_FILES['file_' . $i]['name'])) {
				$_FILES['file']['name'] = $_FILES['file_' . $i]['name'];
				$_FILES['file']['type'] = $_FILES['file_' . $i]['type'];
				$_FILES['file']['tmp_name'] = $_FILES['file_' . $i]['tmp_name'];
				$_FILES['file']['error'] = $_FILES['file_' . $i]['error'];
				$_FILES['file']['size'] = $_FILES['file_' . $i]['size'];

				if ($this->upload->do_upload('file')) {
					array_push($data, $this->upload->data()['file_name']);
				}
			}
		}
	}
	public function filenya()
	{
		$db      = \Config\Database::connect();
		$bfile = $db->table('tblt_attachment');
		if ($file = $this->request->getFile('filepond')) {
			if ($file->isValid() && !$file->hasMoved()) {
				// Get file name and extension
				$name = $file->getName();
				$ext = $file->getClientExtension();

				// Get random file name
				$newName = $file->getRandomName();

				// Store file in public/uploads/ folder
				$file->move('../public/uploads', $newName);

				// File path to display preview
				$filepath = base_url() . "/uploads/" . $newName;

				// Response
				$data['success'] = 1;
				$data['message'] = 'Uploaded Successfully!';
				$data['filepath'] = $filepath;
				$data['extension'] = $ext;
			} else {
				// Response
				$data['success'] = 2;
				$data['message'] = 'File not uploaded.';
			}
		}
	}
	public function formperizinan()
	{
		$session = session();
		if ($session->is_login == True && $session->role == "ADMIN") {
			$data['judul'] = "Form";
			$data['data'] = $this->m_master->getall('tblm_jenisizin', 'namaJenis');
			$data['lokasi'] = $this->m_master->getall('tblm_lokasi', 'nama');
			$data['alat'] = $this->m_master->getall('tblm_peralatan', 'namaPeralatan');
			return view('list/tambahperizinan', $data);
		} else {
			return redirect()->to('/login');
		}
	}
	public function coba()
	{
		$session = session();
		if ($session->is_login == True && $session->role == "ADMIN") {
			$data['judul'] = "Form";
			$data['data'] = $this->m_master->getall('tblm_jenisizin', 'namaJenis');
			$data['lokasi'] = $this->m_master->getall('tblm_lokasi', 'nama');
			$data['alat'] = $this->m_master->getall('tblm_peralatan', 'namaPeralatan');
			return view('form/coba', $data);
		} else {
			return redirect()->to('/login');
		}
	}
	public function t_form()
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('tblt_perizinan');
		$bfile = $db->table('tblt_attachment');
		// $nodokumen = $this->request->getVar('nodokumen');
		$data = [
			'jenisId' => $this->request->getVar('perizinan'),
			'noPerizinan'  => $this->request->getVar('noperizinan'),
			'namaP'  => $this->request->getVar('nama'),
			// 'jenis'  => $this->request->getVar('jenis'),
			// 'lokasi'  => $this->request->getVar('lokasi'),
			'tdeskripsi'  => $this->request->getVar('deskripsi'),
			'tanggalAktif'  => $this->request->getVar('tglaktif'),
			'tanggalBerlaku'  => $this->request->getVar('tglberlaku'),
			'instansi'  => $this->request->getVar('instansi'),
			'alamat'  => $this->request->getVar('alamat'),
			'catatan'  => $this->request->getVar('catatan'),
		];
		$save = $builder->insert($data);
		$idn = $db->insertID();
		$data = [
			'success' => true,
			'data' => $idn,
			'msg' => "Berhasil menambah data"
		];
		return $this->response->setJSON($data['data']);
	}

	public function t_formalat()
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('tblt_peralatan');
		$bfile = $db->table('tblt_attachment');
		// $nodokumen = $this->request->getVar('nodokumen');
		$data = [
			'peralatanId' => $this->request->getVar('peralatan'),
			'noDokumen'  => $this->request->getVar('nodokumen'),
			'noPengesahan'  => $this->request->getVar('nopengesahan'),
			'noUrutDokumen'  => $this->request->getVar('nourut'),
			'kapasitas'  => $this->request->getVar('kapasitas'),
			'lokasiId'  => $this->request->getVar('lokasi2'),
			'tanggalDikeluarkan'  => $this->request->getVar('tglkeluar'),
			'tanggalBerlaku'  => $this->request->getVar('masaberlaku'),
			'periodePerpanjangan'  => $this->request->getVar('panjang'),
			'keteranganPeralatan'  => $this->request->getVar('keterangan'),
		];


		$save = $builder->insert($data);
		$data = [
			'success' => true,
			'data' => $save,
			'msg' => "Berhasil menambah data"
		];
		if ($this->request->getFileMultiple('filepond')) {

			foreach ($this->request->getFileMultiple('filepond') as $file) {

				$file->move(WRITEPATH . 'uploads');

				$data = [
					'perizinanId' => 1,
					'fileDokumen' =>  $file->getClientName(),
					'filePengesahan'  => $file->getClientMimeType()
				];

				$save = $bfile->insert($data);
			}
		}
		return $this->response->setJSON($data['data']);
	}
	public function jenisPerizinan()
	{
		$db      = \Config\Database::connect();
		$dataizin = $db->table('tblm_jenisizin')->get();
		$isi = "";
		foreach ($dataizin->getResultArray() as $row) :
			$isi .= '<option value="' . $row['idJenisIzin'] . '">' . $row['nama'] . '</option>';
		endforeach;
		$msg = [
			'data' => $isi
		];
		echo json_encode($msg);
	}
}
