<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAdmin;
use App\Models\ModelHome;

class Admin extends BaseController
{
    public function __construct()
    {
        $this->ModelAdmin = new ModelAdmin();
        $this->ModelHome = new ModelHome();
    }


    public function index()
    {
        $data = [
            'judul' => 'Dashboard',
            'menu' => 'dashboard',
            'page' => 'backend/v_dashboard',
            'leaderboard' => $this->ModelHome->Leaderboard(),
        ];

        return view('v_template_back', $data);
    }

    public function setting()
    {
        $data = [
            'judul' => 'Setting',
            'menu' => 'setting',
            'page' => 'backend/v_setting',
            'setting' => $this->ModelAdmin->dataSetting(),
        ];
        return view('v_template_back', $data);
    }
    public function updateSetting()
    {
        $data = [
            'nama_kantor' => $this->request->getPost('nama_kantor'),
            'alamat' => $this->request->getPost('alamat'),
            'lokasi_kantor' => $this->request->getPost('lokasi_kantor'),
            'radius' => $this->request->getPost('radius'),
        ];
        $this->ModelAdmin->updateSetting($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diupdate !!!');
        return redirect()->to('Admin/setting');
    }
}
