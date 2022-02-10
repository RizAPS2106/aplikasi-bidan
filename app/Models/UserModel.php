<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_cabang', 'nama', 'telepon', 'email', 'saldo', 'password', 'status_login', 'group_user', 'nama_user_create', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
