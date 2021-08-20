<?php

namespace App\Controllers;

use App\Models\M_master;


class Form extends BaseController
{
	public function __construct()
	{
		$this->m_master = new m_master();
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
	public function index()
	{
		$session = session();

		if ($session->is_login == True && $session->role == "ADMIN") {
			$data['judul'] = "Form";
			$data['data'] = $this->m_master->getall('tblm_jenisizin', 'namaJenis');
			$data['lokasi'] = $this->m_master->getall('tblm_lokasi', 'nama');
			$data['alat'] = $this->m_master->getall('tblm_peralatan', 'namaPeralatan');
			return view('form/index', $data);
		} else {
			return redirect()->to('/login');
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
