<?php

namespace App\Controllers;

use \App\Models\BidanModel;
use \App\Models\KonsumenModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function dashboard()
    {
        $bidan = new BidanModel();
        $konsumen = new KonsumenModel();

        $data['title'] = "Administrator";
        $data['header'] = "Dashboard";
        $data['bidans'] = $bidan->findAll();
        $data['konsumens'] = $konsumen->findAll();

        echo view('admin/admin_dashboard', $data);
    }
}
