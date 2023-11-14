<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAuth extends Model
{
    public function loginKaryawan($username, $password)
    {
        return $this->db->table('tbl_karyawan')->where([
            'username' => $username,
            'password' => $password,
        ])->get()->getRowArray();
    }

    public function loginUser($username, $password)
    {
        return $this->db->table('tbl_user')->where([
            'username' => $username,
            'password' => $password,
        ])->get()->getRowArray();
    }
}
