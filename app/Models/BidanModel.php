<?php

namespace App\Models;

use CodeIgniter\Model;

class BidanModel extends Model
{
    protected $table      = 'bidan';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['nama', 'alamat', 'telepon'];
}
