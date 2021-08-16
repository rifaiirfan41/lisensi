<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelmaster extends Model
{
	function tambah($table, $data)
	{
		return $this->db->table($table)->insert($data);
	}
	function hapus($where, $data)
	{
	}
}
