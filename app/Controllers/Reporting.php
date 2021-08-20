<?php

namespace App\Controllers;

class Reporting extends BaseController
{
	public function index()
	{
		$data['judul'] = "Notifikasi";
		return view('report/index', $data);
	}
}
