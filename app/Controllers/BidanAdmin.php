<?php

namespace App\Controllers;

use \App\Models\UserModel;

class BidanAdmin extends BaseController
{
    public function index()
    {
        $user = new UserModel();
        $data = [
            'title' => "Admin Bidan",
            'header' => "Data Bidan",
            'bidan' => $user->where('group_user', 3)->findAll()
        ];

        echo view('admin/bidan/admin_data_bidan', $data);
    }

    public function preview($id)
    {
        $user = new UserModel();

        $data = [
            'title' => "Admin Bidan",
            'header' => "Detail Bidan",
            'bidan' => $user->where('id', $id)->first()
        ];
        echo view('admin/bidan/admin_detail_bidan', $data);
    }
}
