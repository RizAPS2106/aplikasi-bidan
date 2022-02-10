<?php

namespace App\Models;

use CodeIgniter\Model;

class CabangModel extends Model
{
    protected $table = 'cabang';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['kode_cabang', 'nama', 'alamat'];
}
