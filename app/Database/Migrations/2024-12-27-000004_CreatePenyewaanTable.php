<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePenyewaanTable extends Migration
{
    public function up()
    {
        // Buat tabel penyewaan
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'kostum_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'tanggal_sewa' => [
                'type' => 'DATE',
            ],
            'tanggal_pengembalian_target' => [
                'type' => 'DATE',
            ],
            'durasi_hari' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'harga_sewa_per_hari' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'subtotal_sewa' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'biaya_lainnya' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0,
            ],
            'diskon' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0,
            ],
            'total_harga' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'status_penyewaan' => [
                'type'       => 'ENUM',
                'constraint' => ['pending_bayar', 'aktif', 'selesai', 'dibatalkan'],
                'default'    => 'pending_bayar',
            ],
            'catatan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);

        // Set primary key
        $this->forge->addPrimaryKey('id');

        // Add foreign keys
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('kostum_id', 'kostum', 'id', 'CASCADE', 'CASCADE');

        // Add indexes
        $this->forge->addKey('user_id');
        $this->forge->addKey('kostum_id');
        $this->forge->addKey('status_penyewaan');
        $this->forge->addKey('tanggal_sewa');
        $this->forge->addKey('tanggal_pengembalian_target');

        // Buat tabel
        $this->forge->createTable('penyewaan');
    }

    public function down()
    {
        // Drop tabel penyewaan
        $this->forge->dropTable('penyewaan');
    }
}
