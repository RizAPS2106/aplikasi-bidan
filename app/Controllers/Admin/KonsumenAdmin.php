<?php

namespace App\Controllers\Admin;

use \App\Controllers\BaseController;
use \App\Models\UserModel;
use \App\Models\AlamatModel;

class KonsumenAdmin extends BaseController
{
    public function index()
    {
        $user = new UserModel();

        $data = [
            'title' => "Administrasi Konsumen",
            'header' => "Data Konsumen",
            'konsumen' => $user->select('user.*,master_alamat.alamat')->join('master_alamat', 'master_alamat.id_user = user.id', 'LEFT')->groupBy('user.id')->where('user.group_user', 2)->findAll()
        ];

        echo view('admin/konsumen/admin_data_konsumen', $data);
    }

    public function preview($id)
    {
        $user = new UserModel();
        $alamat = new AlamatModel();

        $data = [
            'title' => "Administrasi Konsumen",
            'header' => "Detail Data Konsumen",
            'konsumen' => $user->where('group_user', 2)->where('id', $id)->first(),
            'alamat' => $alamat->where('id_user', $id)->where('status_alamat', 'enable')->first(),
            'alamat_disable' => $alamat->where('id_user', $id)->where('status_alamat', 'disable')->findAll()
        ];

        echo view('admin/konsumen/admin_detail_konsumen', $data);
    }
}
