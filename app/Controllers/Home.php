<?php

namespace App\Controllers;

use \App\Models\CabangModel;
use \App\Models\LayananModel;

class Home extends BaseController
{
    public function index()
    {
        $cabang = new CabangModel();
        $layanan = new LayananModel();

        $data = [
            'title' => 'Beranda',
            'cabang' => $cabang->findAll(),
            'layanan' => $layanan->findAll()
        ];

        return view('home', $data);
    }
}
