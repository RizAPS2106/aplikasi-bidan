<?php

namespace App\Controllers\Admin;

use \App\Controllers\BaseController;
use \App\Models\CabangModel;
use \App\Models\UserModel;

class CabangAdmin extends BaseController
{
    public function index()
    {
        $cabang = new CabangModel();
        $user = new UserModel();

        $data = [
            'title' => "Administrasi Cabang",
            'header' => "Data Cabang",
            'cabang' => $cabang->findAll(),
            'owner' => $user->where('group_user', 1)->findAll()
        ];

        echo view('admin/cabang/admin_data_cabang', $data);
    }

    public function preview($id)
    {
        $cabang = new CabangModel();

        $data = [
            'title' => "Administrasi Cabang",
            'header' => "Detail Data Cabang",
            'cabang' => $cabang->select('cabang.*,user.id as id_user,user.nama as nama_user,user.group_user')->join('user', 'user.id_cabang = cabang.id', 'LEFT')->where('cabang.id', $id)->where('user.group_user', 1)->first()
        ];

        echo view('admin/cabang/admin_detail_cabang', $data);
    }
}
