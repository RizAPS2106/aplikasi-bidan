<?php

namespace App\Controllers\Admin;

use \App\Controllers\BaseController;
use \App\Models\UserModel;

class KonsumenAdmin extends BaseController
{
    public function index()
    {
        $user = new UserModel();
        $data = [
            'title' => "Admin Konsumen",
            'header' => "Data Konsumen",
            'konsumen' => $user->where('group_user', 2)->findAll()
        ];

        echo view('admin/konsumen/admin_data_konsumen', $data);
    }

    public function preview($id)
    {
        $user = new UserModel();

        $data = [
            'title' => "Admin Konsumen",
            'header' => "Detail Konsumen",
            'konsumen' => $user->where('id', $id)->first()
        ];
        echo view('admin/konsumen/admin_detail_konsumen', $data);
    }
}
