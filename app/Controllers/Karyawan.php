<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelKaryawan;
use App\Models\ModelJabatan;


class Karyawan extends BaseController
{
    public function __construct()
    {
        $this->ModelKaryawan = new ModelKaryawan();
        $this->ModelJabatan = new ModelJabatan();
    }

    public function index()
    {
        $pager = service('pager');

        $page    = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 5;
        $total   = 200;

        // Call makeLinks() to make pagination links.
        $pager_links = $pager->makeLinks($page, $perPage, $total, 'pagination');
        $data = [
            'judul' => 'Karyawan',
            'menu' => 'karyawan',
            'page' => 'backend/v_karyawan',
            'karyawan' => $this->ModelKaryawan->allData(),
            'jabatan' => $this->ModelJabatan->allData(),
            // ...
            'pager_links' => $pager_links,
        ];
        return view('v_template_back', $data);
    }



    public function insertData()
    {
        $foto = $this->request->getFile('foto_karyawan');
        $file_name = $foto->getRandomName();

        $data = [
            'id_jabatan' => $this->request->getPost('id_jabatan'),
            'nik' => $this->request->getPost('nik'),
            'nama_karyawan' => $this->request->getPost('nama_karyawan'),
            'username' => $this->request->getPost('username'),
            'password' => sha1($this->request->getPost('password')),
            'foto_karyawan' => $file_name,
        ];
        $foto->move('foto', $file_name);
        $this->ModelKaryawan->insertData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambah !!');
        return redirect()->to('Karyawan');
    }



    public function updateData($id_karyawan)
    {

        $foto = $this->request->getFile('foto_karyawan');
        $file_name = $foto->getRandomName();
        if ($foto->getError() == 4) {
            $data = [
                'id_karyawan' => $id_karyawan,
                'id_jabatan' => $this->request->getPost('id_jabatan'),
                'nik' => $this->request->getPost('nik'),
                'nama_karyawan' => $this->request->getPost('nama_karyawan'),
                'username' => $this->request->getPost('username'),
            ];

            $this->ModelKaryawan->updateData($data);
        } else {
            $data = [
                'id_karyawan' => $id_karyawan,
                'id_jabatan' => $this->request->getPost('id_jabatan'),
                'nik' => $this->request->getPost('nik'),
                'nama_karyawan' => $this->request->getPost('nama_karyawan'),
                'username' => $this->request->getPost('username'),
                'password' => sha1($this->request->getPost('password')),
                'foto_karyawan' => $file_name,
            ];
            $foto->move('foto', $file_name);
            $this->ModelKaryawan->updateData($data);
        }
        session()->setFlashdata('pesan', 'Data Berhasil Diedit !!');
        return redirect()->to('Karyawan');
    }

    public function deleteData($id_karyawan)
    {
        $data = [
            'id_karyawan' => $id_karyawan,
        ];
        $this->ModelKaryawan->deleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus !!');
        return redirect()->to('Karyawan');
    }
}
