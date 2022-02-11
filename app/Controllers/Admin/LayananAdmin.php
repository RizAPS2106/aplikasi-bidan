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
            'title' => "Admin Konsumen",
            'header' => "Data Konsumen",
            'layanan' => $layanan->findAll()
        ];

        echo view('admin/layanan/admin_data_layanan', $data);
    }
}
