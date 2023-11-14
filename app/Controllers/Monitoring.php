<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelMonitoring;
use CodeIgniter\Pager\PagerInterface;

class Monitoring extends BaseController
{
    protected $ModelMonitoring;
    public function __construct()
    {
        $this->ModelMonitoring = new ModelMonitoring();
    }

    public function index()
    {


        $data = [
            'judul' => 'Monitoring',
            'menu' => 'monitoring',
            'page' => 'backend/v_monitoring',
            'monitoring' => $this->ModelMonitoring->allData(),

        ];
        return view('v_template_back', $data);
    }
}
