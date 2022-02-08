<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'nama'       => [
                'type'           => 'VARCHAR',
                'constraint'     => 100
            ],
            'telepon' => [
                'type'           => 'VARCHAR',
                'constraint'     => 15
            ],
            'email'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 100
            ],
            'saldo'      => [
                'type'           => 'decimal',
                'constraint'     => 10, 2
            ],
            'password' => [
                'type'           => 'text',
                'null'           => false
            ],
            'status_login' => [
                'type'           => "enum('login','logout')",
                'default'        => 'logout',
                'null'           =>  false
            ],
            'group_user' => [
                'type'           => 'int',
                'constraint'     => 10
            ],
            'nama_user_create' => [
                'type'           => 'varchar',
                'constraint'     => 100,
                'null'           => true
            ],

            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id', TRUE);

        $this->forge->createTable('user', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
