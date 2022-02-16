<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Order extends Migration
{
    public function up()
    {
        // Master Alamat
        $this->forge->addField([
            'id'                 => [
                'type'             => 'BIGINT',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'id_user'            => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
            ],
            'alamat'               => [
                'type'           => "TEXT",
                'null'           => false
            ],
            'status_alamat'               => [
                'type'           => "ENUM('enable','disable')",
                'default'        => 'disable'
            ]
        ]);

        $this->forge->addKey('id', TRUE);

        $this->forge->addForeignKey('id_user', 'user', 'id');

        $this->forge->createTable('master_alamat', TRUE);

        // Order
        $this->forge->addField([
            'id'                 => [
                'type'             => 'BIGINT',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'invoice'            => [
                'type'           => 'VARCHAR',
                'constraint'     => 10,
            ],
            'total_harga'        => [
                'type'           => 'DECIMAL',
                'constraint'     => 10, 2
            ]
        ]);

        $this->forge->addKey('id', TRUE);

        $this->forge->createTable('order', TRUE);

        //Detail Order
        $this->forge->addField([
            'id'                 => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'invoice'            => [
                'type'           => 'VARCHAR',
                'constraint'     => 10
            ],
            'id_user'               => [
                'type'           => 'BIGINT',
                'constraint'     => 11
            ],
            'id_layanan'             => [
                'type'           => 'BIGINT',
                'null'           => 11
            ],
            'harga'              => [
                'type'           => 'DECIMAl',
                'null'           => 10, 2
            ],
            'jadwal'             => [
                'type'           => 'DATETIME'
            ],
            'layanan_detail'             => [
                'type'           => "ENUM('onsite','homecare')"
            ],
            'id_alamat'             => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
                'null'           => true
            ],
            'tracking'             => [
                'type'           => "ENUM('menuju_lokasi,progress,done')"
            ]
        ]);

        $this->forge->addKey('id', TRUE);

        $this->forge->addForeignKey('id_user', 'user', 'id');
        $this->forge->addForeignKey('id_layanan', 'layanan', 'id');
        $this->forge->addForeignKey('id_alamat', 'master_alamat', 'id');
        $this->forge->addForeignKey('invoice', 'order', 'invoice');

        $this->forge->createTable('detail_order', TRUE);

        // Transaksi
        $this->forge->addField([
            'id'                 => [
                'type'             => 'BIGINT',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'id_order'           => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
            ],
            'detail_transaksi'   => [
                'type'           => "ENUM('dp','lunas','belum_lunas')"
            ]
        ]);

        $this->forge->addKey('id', TRUE);

        $this->forge->addForeignKey('id_order', 'order', 'id');

        $this->forge->createTable('transaksi', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('cabang');
        $this->forge->dropTable('user');
    }
}
