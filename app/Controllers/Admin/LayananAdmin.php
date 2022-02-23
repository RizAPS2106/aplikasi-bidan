<?php

namespace App\Controllers\Admin;

use \App\Controllers\BaseController;
use \App\Models\LayananModel;

class LayananAdmin extends BaseController
{
    public function index()
    {
        $layanan = new LayananModel();

        $data = [
            'title' => "Administrasi Layanan",
            'header' => "Data Layanan",
            'layanan' => $layanan->findAll()
        ];

        echo view('admin/layanan/admin_data_layanan', $data);
    }
}
