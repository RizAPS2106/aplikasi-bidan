<?php

namespace App\Controllers;

use \App\Models\BidanModel;
use \App\Models\KonsumenModel;
use \App\Models\UsersModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

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
