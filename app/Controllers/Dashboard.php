<?php

namespace App\Controllers;

use phpDocumentor\Reflection\PseudoTypes\False_;
use phpDocumentor\Reflection\PseudoTypes\True_;

class Dashboard extends BaseController
{

	public function index()
	{
		$session = session();
		if ($session->is_login == True) {
			$data['judul'] = "Dashboard";
			return view('dashboard/index', $data);
		} else {
			return redirect()->to('/login');
		}
	}
}
