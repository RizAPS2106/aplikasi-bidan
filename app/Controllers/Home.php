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
}
