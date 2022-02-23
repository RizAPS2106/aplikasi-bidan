<?php

namespace App\Controllers\Admin;

use \App\Controllers\BaseController;
use \App\Models\UserModel;
use \App\Models\CabangModel;

class BidanAdmin extends BaseController
{
    public function index()
    {
        $user = new UserModel();
        $cabang = new CabangModel();

        $data = [
            'title' => "Administrasi Bidan",
            'header' => "Data Bidan",
            'bidan' => $user->where('group_user', 3)->findAll(),
            'cabang' => $cabang->findAll()
        ];

        echo view('admin/bidan/admin_data_bidan', $data);
    }

    public function preview($id)
    {
        $user = new UserModel();

        $data = [
            'title' => "Administrasi Bidan",
            'header' => "Detail Data Bidan",
            'bidan' => $user->select('user.*,cabang.nama as nama_cabang')->join('cabang', 'cabang.id = user.id_cabang', 'LEFT')->where('user.id', $id)->first()
        ];

        echo view('admin/bidan/admin_detail_bidan', $data);
    }
}
