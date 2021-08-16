<?php

namespace App\Controllers;

class Notifikasi extends BaseController
{
	public function index()
	{
		$data['judul'] = "Notifikasi";
		return view('notifikasi/index', $data);
	}
}
