<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePembayaranTable extends Migration
{
    public function up()
    {
        // Buat tabel pembayaran
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'penyewaan_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'metode_pembayaran' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'jumlah_dibayar' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'bukti_pembayaran_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'status_pembayaran' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'confirmed', 'expired', 'rejected'],
                'default'    => 'pending',
            ],
            'catatan_pembayaran' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'tanggal_pembayaran' => [
                'type' => 'TIMESTAMP',
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

        // Add unique key untuk penyewaan_id (1 penyewaan hanya 1 pembayaran)
        $this->forge->addUniqueKey('penyewaan_id');

        // Add foreign keys
        $this->forge->addForeignKey('penyewaan_id', 'penyewaan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');

        // Add indexes
        $this->forge->addKey('user_id');
        $this->forge->addKey('status_pembayaran');

        // Buat tabel
        $this->forge->createTable('pembayaran');
    }

    public function down()
    {
        // Drop tabel pembayaran
        $this->forge->dropTable('pembayaran');
    }
}
