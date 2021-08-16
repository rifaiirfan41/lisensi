<?php

namespace App\Controllers;

class Login extends BaseController
{
	public function __construct()
	{
		$this->session = session();
	}
	public function index()
	{
		$session = session();
		if ($session->is_login == 1) {
			return redirect()->to('/dashboard');
		} else {
			return view('login/index');
		}
	}
	public function processlogin()
	{
		$session = session();
		// $d = \Config\Services::request();
		// $d->getPost();
		$username = $this->request->getVar('username');
		$password = $this->request->getVar('password');
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://114.6.64.2:11232/AppManagerV2/api/auth/loginv2",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => array('app_name' => 'Sio', 'username' => $username, 'password' => $password),
		));

		$response = curl_exec($curl);

		curl_close($curl);

		$response_arr = json_decode($response);

		// echo '<pre>';
		// print_r($response_arr);
		// echo '</pre>';
		if ($response_arr) {
			if ($response_arr->data->app == 'Sio') {
				if ($response_arr->data->roleGroup[0] == "ADMIN" or $response_arr->data->roleGroup[0] == "GM") {
					$data = [
						'username'    	=> $response_arr->data->username,
						'role'      	=> $response_arr->data->roleGroup[0],
						'id'        	=> $response_arr->data->id,
						'nama_lengkap'  => $response_arr->data->nama_lengkap,
						'nama_perusahaan' => $response_arr->data->nama_perusahaan,
						'location'      => $response_arr->data->authParam->value0->auth_value,
						'is_login'  	=> true,
					];
					$session->set($data);
					return redirect()->to('/dashboard');
				} else {
					$session->setFlashdata('fail', '<div class="alert alert-danger" role="alert">Sorry you can\'t get this application, please contact IT Support !</div>');
					return redirect()->to('/login');
				}
			} else {
				$session->setFlashdata('fail', '<div class="alert alert-danger" role="alert">Sorry you can\'t get this application, please contact IT Support !</div>');
				return redirect()->to('/login');
			}
		} else {
			$session->setFlashdata('fail', '<div class="alert alert-danger" role="alert">Sorry you username or password is wrong !</div>');
			return redirect()->to('/login');
		}
	}
	public function logout()
	{
		$session = session();
		$data = ['username', 'role', 'id', 'nama_lengkap', 'nama_perusahaan', 'location', 'is_login'];
		$session->remove($data);
		$session->setFlashdata('success', '<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
		The account successfully logged out !!!</div>');
		return redirect()->to('/login');
	}
}
