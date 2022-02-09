<?php

namespace App\Controllers;

use \App\Models\UserModel;

class KonsumenAdmin extends BaseController
{
    public function index()
    {
        $user = new UserModel();
        $data = [
            'title' => "Admin konsumen",
            'header' => "Data konsumen",
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
