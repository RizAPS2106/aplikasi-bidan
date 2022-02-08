<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Konsumen extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'nama'       => [
                'type'           => 'VARCHAR',
                'constraint'     => 100
            ],
            'alamat'      => [
                'type'           => 'TEXT',
                'null'           => true
            ],
            'telepon' => [
                'type'           => 'VARCHAR',
                'constraint'           => 15
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id', TRUE);

        $this->forge->createTable('konsumen', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('konsumen');
    }
}
