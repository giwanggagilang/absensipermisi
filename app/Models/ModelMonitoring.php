<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelMonitoring extends Model
{
    protected $table = 'tbl_presensi';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_presensi', 'id_karyawan', 'tgl_presensi', 'jam_in', 'jam_out', 'foto_in', 'foto_out', 'lokasi_in', 'lokasi_out'];

    public function allData()
    {

        return $this->db->table('tbl_presensi')
            ->join('tbl_karyawan', 'tbl_karyawan.id_karyawan=tbl_presensi.id_karyawan', 'LEFT')
            ->join('tbl_jabatan', 'tbl_jabatan.id_jabatan=tbl_karyawan.id_jabatan', 'LEFT')

            ->orderBy('tbl_presensi.id_presensi', 'DESC')
            ->get()->getResultArray();
    }
}
