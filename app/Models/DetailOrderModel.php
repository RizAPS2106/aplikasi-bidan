<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailOrderModel extends Model
{
    protected $table = 'detail_order';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['invoice', 'id_user', 'id_layanan', 'harga', 'jadwal', 'layanan_detail', 'id_alamat', 'tracking'];
}
