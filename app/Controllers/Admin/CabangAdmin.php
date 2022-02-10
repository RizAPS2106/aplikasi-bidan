<?php

namespace App\Controllers\Admin;

use \App\Controllers\BaseController;
use \App\Models\CabangModel;

class CabangAdmin extends BaseController
{
    public function index()
    {
        $cabang = new CabangModel();
        $data = [
            'title' => "Admin Cabang",
            'header' => "Data Cabang",
            'cabang' => $cabang->findAll()
        ];

        echo view('admin/cabang/admin_data_cabang', $data);
    }

    public function preview($id)
    {
        $cabang = new CabangModel();
        $data = [
            'title' => "Admin Cabang",
            'header' => "Detail Cabang",
            'cabang' => $cabang->where('id', $id)->first()
        ];

        echo view('admin/cabang/admin_detail_cabang', $data);
    }
}
