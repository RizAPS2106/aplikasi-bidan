<?php

namespace App\Controllers;

use \App\Models\CabangModel;
use \App\Models\LayananModel;

class Home extends BaseController
{
    public function index()
    {
        $layanan = new LayananModel();
        $cabang = new CabangModel();

        $data = [
            'title' => 'Beranda',
            'layanan' => $layanan->findAll(),
            'cabang' => $cabang->findAll()
        ];

        return view('home', $data);
    }
}
