<?php

namespace App\Controllers;

use App\Models\M_master;
use App\Models\MPeraturan;

class Peraturan extends BaseController
{
	public function __construct()
	{
		$this->m_master = new m_master();
	}
	public function ajax_child()
	{
		$request = \Config\Services::request();
		$data = $this->m_master->getall('tblm_lokasi', 'nama');
		foreach ($data as $produk) {
			$data[] = array(
				'barcode' => $produk->barcode,
				'nama' => $produk->nama_produk,
				'kategori' => $produk->kategori,
				'satuan' => $produk->satuan,
				'hargaBeli' => 'Rp. ' . number_format($produk->hargaBeli),
				'harga' => 'Rp. ' . number_format($produk->harga),
				'stok' => $produk->stok,
				'action' => '<button class="btn btn-sm btn-success" onclick="edit(' . $produk->id . ')">Edit</button> <button class="btn btn-sm btn-danger" onclick="remove(' . $produk->id . ')">Delete</button>'
			);
		}

		$produk = array(
			'data' => $data
		);
		echo json_encode($produk);
	}
	public function index()
	{
		$data['judul'] = "Peraturan";
		return view('peraturan/index', $data);
	}
	public function coba()
	{
		$data['judul'] = "Peraturan";
		return view('peraturan/index', $data);
	}
	public function form()
	{
		$data['judul'] = "Form";
		$data['data'] = $this->m_master->getall('tblm_jenisidentifikasi', 'nama');
		return view('peraturan/form', $data);
	}
	public function ajax_list()
	{
		$request = \Config\Services::request();
		$model = new MPeraturan();
		$where = array('tblt_identifikasiperaturan.is_active' => '1');

		$column_order = array('tblt_identifikasiperaturan.id', 'noPeraturan', 'judul', 'bab', 'pasal', 'ayat', 'tentang', 'fasilitas', 'dokumenKerja', 'statusPemenuhan', 'keterangan', 'nama');
		$column_search = array('noPeraturan', 'judul', 'bab', 'pasal', 'ayat', 'tentang', 'fasilitas', 'dokumenKerja', 'statusPemenuhan', 'keterangan', 'nama');
		$order = array('tblt_identifikasiperaturan.id' => 'DESC');
		$listing = $model->get_datatables('tblt_identifikasiperaturan', $column_order, $column_search, $order, $where);
		$data = array();
		$no = $request->getPost("start");


		foreach ($listing as $key) {
			if ($key->statusPemenuhan == "Sudah") {
				$sudah = "<div class='bg-success text-center'>V</div>";
				$proses = "";
				$belum = "";
			} else if ($key->statusPemenuhan == "Proses") {
				$sudah = "";
				$proses = "<div class='bg-warning text-center'>V</div>";
				$belum = "";
			} else if ($key->statusPemenuhan == "Belum") {
				$sudah = "";
				$proses = "";
				$belum = "<div class='bg-danger text-center'>V</div>";
			}
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $key->noPeraturan;
			$row[] = $key->judul;
			$row[] = $key->bab;
			$row[] = $key->pasal;
			$row[] = $key->ayat;
			$row[] = $key->tentang;
			$row[] = $key->fasilitas;
			$row[] = $key->dokumenKerja;
			$row[] = $sudah;
			$row[] = $proses;
			$row[] = $belum;
			$row[] = $key->keterangan;
			$row[] = '<div class="float-right"><a href="javascript:void(0)" class="itemtambah" data-peraturanid="' . $key->id . '"  style="font-size:12px;"><i class="fa fa-plus"></i></a> <a class="mr-2" style="color: black;" href="javascript:void(0)" title="Destroy" onclick="delete_data(' . "'" . $key->id . "'" . ')" style="font-size:12px;" ><i class="fa fa-trash"></i></a></div>';
			$row[] = $key->nama;
			$data[] = $row;
		}

		$output = array(
			"draw" => $request->getPost("draw"),
			"recordsTotal" => $model->jumlah_semua('tblt_identifikasiperaturan', $where),
			"recordsFiltered" => $model->jumlah_filter('tblt_identifikasiperaturan', $column_order, $column_search, $order, $where),
			"data" => $data
		);
		echo json_encode($output);
	}
	public function ajax_tambahrelavan()
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('tblt_peraturanrelavan');
		$data = [
			// 'jenisId' => $this->request->getVar('perizinan'),
			'idPeraturan' => $this->request->getVar('idPeraturan'),
			'bab'  => $this->request->getVar('bab'),
			'pasal'  => $this->request->getVar('pasal'),
			'ayat'  => $this->request->getVar('ayat'),
			'tentang'  => $this->request->getVar('tentang'),
			'fasilitas'  => $this->request->getVar('fasilitas'),
			'dokumenKerja'  => $this->request->getVar('dokumenKerja'),
			'statusPemenuhan'  => $this->request->getVar('statusPemenuhan'),
			'keterangan'  => $this->request->getVar('keterangan'),
		];

		$save = $builder->insert($data);
		$data = [
			'success' => true,
			'data' => $data,
			'msg' => "Berhasil mengubah data"
		];

		return $this->response->setJSON($data);
	}
	public function tamform()
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('tblt_identifikasiperaturan');
		$relavan = $db->table('tblt_peraturanrelavan');
		// $nodokumen = $this->request->getVar('nodokumen');
		$data = [
			'jenisIdentifikasiId' => $this->request->getVar('peraturan'),
			'noPeraturan'  => $this->request->getVar('noperaturan'),
			'judul'  => $this->request->getVar('judul'),
		];
		$data2 = [
			'idPeraturan' => $this->request->getVar('peraturan'),
			'bab'  => $this->request->getVar('bab'),
			'pasal'  => $this->request->getVar('pasal'),
			'ayat'  => $this->request->getVar('ayat'),
			'tentang'  => $this->request->getVar('tentang'),
			'fasilitas'  => $this->request->getVar('fasilitas'),
			'dokumenKerja'  => $this->request->getVar('dokkerja'),
			'statusPemenuhan'  => $this->request->getVar('status'),
			'keterangan'  => $this->request->getVar('keterangan'),
		];
		$save = $builder->insert($data);
		$idn = $db->insertID();
		$data2 = [
			'idPeraturan' => $idn,
			'bab'  => $this->request->getVar('bab'),
			'pasal'  => $this->request->getVar('pasal'),
			'ayat'  => $this->request->getVar('ayat'),
			'tentang'  => $this->request->getVar('tentang'),
			'fasilitas'  => $this->request->getVar('fasilitas'),
			'dokumenKerja'  => $this->request->getVar('dokkerja'),
			'statusPemenuhan'  => $this->request->getVar('status'),
			'keterangan'  => $this->request->getVar('keterangan'),
		];
		$relavan->insert($data2);
		// $idn = $db->insertID();
		$datane = [
			'success' => true,
			'data' => $idn,
			'msg' => "Berhasil menambah data"
		];
		return $this->response->setJSON($datane['success']);
	}
	public function formchild()
	{
		$bab = $this->request->getVar('bab');
		$pasal = $this->request->getVar('pasal');
		$ayat = $this->request->getVar('ayat');
		$data = array(
			'bab' => $bab,
			'pasal' => $pasal,
			'ayat' => $ayat,
		);
		return $this->response->setJSON($data[]);
	}
}
