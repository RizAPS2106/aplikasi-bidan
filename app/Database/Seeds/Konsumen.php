<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Konsumen extends Seeder
{
	public function run()
	{
		$data_konsumen = [
			[
				'nama' => 'Testing 4',
				'alamat'  => 'Testing 4',
				'telepon' => '0888888888'
			],
			[
				'nama' => 'Testing 5',
				'alamat' => 'Testing 5',
				'telepon' => '0888888888'
			],
			[
				'nama' => 'Testing 6',
				'alamat'	=> 'Testing 6',
				'telepon' => '0888888888'
			]
		];

		foreach ($data_konsumen as $data) {
			$this->db->table('konsumen')->insert($data);
		}
	}
}
