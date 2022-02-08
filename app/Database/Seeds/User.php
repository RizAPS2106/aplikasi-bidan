<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    public function run()
    {
        $user_data = [
            [
                'nama' => 'Testing 1',
                'telepon' => '0888888888',
                'email' => '123@gmail.com',
                'saldo' => '10000000',
                'password' => md5('password'),
                'group_user' => 1,
            ],
            [
                'nama' => 'Testing 2',
                'telepon' => '0888888888',
                'email' => '123@gmail.com',
                'saldo' => '10000000',
                'password' => md5('password'),
                'group_user' => 2,
            ],
            [
                'nama' => 'Testing 3',
                'telepon' => '0888888888',
                'email' => '123@gmail.com',
                'saldo' => '10000000',
                'password' => md5('password'),
                'group_user' => 3,
            ]
        ];

        foreach ($user_data as $data) {
            $this->db->table('user')->insert($data);
        }
    }
}
