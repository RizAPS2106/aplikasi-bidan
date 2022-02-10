<?php

namespace App\Controllers\Admin;

use \App\Controllers\BaseController;
use \App\Models\UserModel;
use \App\Models\CabangModel;

class OwnerAdmin extends BaseController
{
    public function index()
    {
        $user = new UserModel();
        $cabang = new CabangModel();
        $data = [
            'title' => "Admin Owner",
            'header' => "Data Owner",
            'owner' => $user->where('group_user', 1)->findAll(),
            'cabang' => $cabang->findAll()
        ];

        echo view('admin/owner/admin_data_owner', $data);
    }

    public function preview($id)
    {
        $user = new UserModel();

        $data = [
            'title' => "Admin Owner",
            'header' => "Detail Owner",
            'owner' => $user->where('id', $id)->first()
        ];
        echo view('admin/owner/admin_detail_owner', $data);
    }
}
