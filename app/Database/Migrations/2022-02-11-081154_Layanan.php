<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Layanan extends Migration
{
    public function up()
    {
        //Cabang
        $this->forge->addField([
            'id'          => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'nama_layanan'        => [
                'type'           => 'VARCHAR',
                'constraint'     => 50
            ],
            'harga'               => [
                'type'           => 'DECIMAL'
            ]
        ]);

        $this->forge->addKey('id', TRUE);

        $this->forge->createTable('layanan', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('layanan');
    }
}
