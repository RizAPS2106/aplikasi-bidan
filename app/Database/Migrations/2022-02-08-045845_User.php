<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
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
            'kode_cabang'        => [
                'type'           => 'VARCHAR',
                'constraint'     => 10
            ],
            'nama'               => [
                'type'           => 'VARCHAR',
                'constraint'     => 100
            ],
            'alamat'             => [
                'type'           => 'TEXT',
                'null'           => false
            ],
        ]);

        $this->forge->addKey('id', TRUE);

        $this->forge->createTable('cabang', TRUE);

        // User
        $this->forge->addField([
            'id'                 => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'id_cabang'          => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
                'null'           => true
            ],
            'nama'               => [
                'type'           => 'VARCHAR',
                'constraint'     => 100
            ],
            'telepon'            => [
                'type'           => 'VARCHAR',
                'constraint'     => 15
            ],
            'email'              => [
                'type'           => 'VARCHAR',
                'constraint'     => 100
            ],
            'saldo'              => [
                'type'           => 'DECIMAl',
                'constraint'     => 10, 2
            ],
            'password'           => [
                'type'           => 'TEXT',
                'null'           => false
            ],
            'status_login'       => [
                'type'           => "ENUM('login','logout')",
                'default'        => 'logout',
                'null'           =>  false
            ],
            'group_user'         => [
                'type'           => 'INT',
                'constraint'     => 10
            ],
            'created_by'   => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'null'           => true
            ],

            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id', TRUE);

        $this->forge->addForeignKey('id_cabang', 'cabang', 'id');

        $this->forge->createTable('user', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('cabang');
        $this->forge->dropTable('user');
    }
}
