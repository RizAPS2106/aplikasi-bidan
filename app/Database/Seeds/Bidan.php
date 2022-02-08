<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Bidan extends Seeder
{
    public function run()
    {
        $bidan_data = [
            [
                'nama' => 'Testing 1',
                'alamat'  => 'Testing 1',
                'telepon' => '0888888888'
            ],
            [
                'nama' => 'Testing 2',
                'alamat' => 'Testing 2',
                'telepon' => '0888888888'
            ],
            [
                'nama' => 'Testing 3',
                'alamat'    => 'Testing 3',
                'telepon' => '0888888888'
            ]
        ];

        foreach ($bidan_data as $data) {
            $this->db->table('bidan')->insert($data);
        }
    }
}
