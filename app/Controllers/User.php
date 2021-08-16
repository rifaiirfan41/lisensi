<?php

namespace App\Controllers;

use App\Models\User_model;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use \Firebase\JWT\JWT;
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

class User extends ResourceController
{
    use ResponseTrait;

    public function createUser()
    {
        $userModel = new User_model();

        $data = [
            "user_nama" => $this->request->getVar("user_nama"),
            "username" => $this->request->getVar("username"),
            "role" => $this->request->getVar("role"),
            "password" => password_hash($this->request->getVar("password"), PASSWORD_DEFAULT),
        ];

        if ($userModel->insert($data)) {

            $response = [
                'status' => 200,
                "error" => FALSE,
                'messages' => 'User dibuat',
            ];
        } else {

            $response = [
                'status' => 500,
                "error" => TRUE,
                'messages' => 'Gagal dibuat',
            ];
        }

        return $this->respondCreated($response);
    }

    private function getKey()
    {
        $kunci = "rahasiasiolisensi";
        return $kunci;
    }

    public function validateUser()
    {
        // use \Firebase\JWT\JWT;
        $userModel = new User_model();
        $email         = $this->request->getPost('username');
        $password     = $this->request->getPost('password');
        // $key = $this->input->post('key');
        // $cek_login = $this->User_model->cek_login($email);
        $cek_login = $userModel->where("username", $this->request->getVar("username"))->first();

        // var_dump($cek_login['password']);

        if (password_verify($password, $cek_login['password'])) {
            $secret_key = $this->getKey();
            $issuer_claim = "THE_CLAIM"; // this can be the servername. Example: https://domain.com
            $audience_claim = "THE_AUDIENCE";
            $issuedat_claim = time(); // issued at
            $notbefore_claim = $issuedat_claim + 10; //not before in seconds
            // $expire_claim = $issuedat_claim + 9192631770; // expire time in seconds
            $token = array(
                "iss" => $issuer_claim,
                "aud" => $audience_claim,
                "iat" => $issuedat_claim,
                "nbf" => $notbefore_claim,
                // "exp" => $expire_claim,
                "data" => array(
                    "user_id" => $cek_login['user_id'],
                    "user_nama" => $cek_login['user_nama'],
                    "role" => $cek_login['role'],
                    // "email" => $cek_login['email']
                )
            );

            $token = JWT::encode($token, $secret_key);

            $output = [
                'status' => 200,
                'message' => 'Berhasil login',
                "token" => $token,
                "email" => $email,
                // "expireAt" => $expire_claim
            ];
            return $this->respond($output, 200);
        } else {
            $output = [
                'status' => 401,
                'message' => 'Login failed',
                "password" => $password
            ];
            return $this->respond($output, 401);
        }

        // $userModel = new User_model();

        // $userdata = $userModel->where("username", $this->request->getVar("username"))->first();

        // if (!empty($userdata)) {

        //     if (password_verify($this->request->getVar("password"), $userdata['password'])) {

        //         $key = $this->getKey();

        //         $iat = time();
        //         $nbf = $iat + 10;
        //         $exp = $iat + 3600;

        //         $payload = array(
        //             "iss" => "The_claim",
        //             "aud" => "The_Aud",
        //             "iat" => $iat,
        //             "nbf" => $nbf,
        //             "exp" => $exp,
        //             "data" => $userdata,
        //         );

        //         $token = JWT::encode($payload, $key);

        //         $response = [
        //             'status' => 200,
        //             'error' => FALSE,
        //             'messages' => 'Login Sukses',
        //             'token' => $token
        //         ];
        //         return $this->respondCreated($response);
        //     } else {

        //         $response = [
        //             'status' => 500,
        //             'error' => TRUE,
        //             'messages' => 'Incorrect details'
        //         ];
        //         return $this->respondCreated($response);
        //     }
        // } else {
        //     $response = [
        //         'status' => 500,
        //         'error' => TRUE,
        //         'messages' => 'User not found'
        //     ];
        //     return $this->respondCreated($response);
        // }
    }

    public function userDetails()
    {
        $key = $this->getKey();
        $authHeader = $this->request->getHeader("Authorization");
        $authHeader = $authHeader->getValue();
        $token = $authHeader;

        try {
            $decoded = JWT::decode($token, $key, array("HS256"));

            if ($decoded) {

                $response = [
                    'status' => 200,
                    'error' => FALSE,
                    'messages' => 'Detail User',
                    'data' => $decoded
                ];
                return $this->respondCreated($response);
            }
        } catch (Exception $ex) {
            $response = [
                'status' => 401,
                'error' => TRUE,
                'messages' => 'Akses Tidak Diperbolehkan'
            ];
            return $this->respondCreated($response);
        }
    }
}
