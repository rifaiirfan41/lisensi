<?php

namespace App\Models;

use CodeIgniter\Model;

class M_master extends Model
{


    function getall($tabel, $field)
    {
        return $this->db->query("SELECT * FROM $tabel WHERE is_active=1 ORDER BY $field ASC ")->getResult('array');
    }
}
