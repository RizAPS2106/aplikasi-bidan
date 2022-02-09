<?php

namespace App\Controllers;

use \App\Models\UsersModel;

class Admin extends BaseController
{
    public function dashboard()
    {
        $user = new UsersModel();

        $data = [
            'title' => "Administrator",
            'header' => "Dashboard",
            'bidans' => $user->where('group_user', 3)->findAll(),
            'admins' => $user->where('group_user', 2)->findAll(),
            'konsumens' => $user->where('group_user', 1)->findAll()
        ];

        echo view('admin/admin_dashboard', $data);
    }
}
