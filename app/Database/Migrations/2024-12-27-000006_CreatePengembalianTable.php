<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePengembalianTable extends Migration
{
    public function up()
    {
        // Buat tabel pengembalian
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
            'tanggal_pengembalian_aktual' => [
                'type' => 'DATE',
            ],
            'status_kondisi' => [
                'type'       => 'ENUM',
                'constraint' => ['baik', 'lecet', 'rusak_ringan', 'rusak_berat', 'hilang'],
                'default'    => 'baik',
            ],
            'catatan_kondisi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'denda_keterlambatan' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0,
            ],
            'biaya_perbaikan' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0,
            ],
            'total_denda' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0,
            ],
            'foto_kondisi_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'status_pengembalian' => [
                'type'       => 'ENUM',
                'constraint' => ['pending_verifikasi', 'accepted', 'rejected'],
                'default'    => 'pending_verifikasi',
            ],
            'catatan_admin' => [
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

        // Add unique key untuk penyewaan_id (1 penyewaan hanya 1 pengembalian)
        $this->forge->addUniqueKey('penyewaan_id');

        // Add foreign keys
        $this->forge->addForeignKey('penyewaan_id', 'penyewaan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');

        // Add indexes
        $this->forge->addKey('user_id');
        $this->forge->addKey('status_pengembalian');

        // Buat tabel
        $this->forge->createTable('pengembalian');
    }

    public function down()
    {
        // Drop tabel pengembalian
        $this->forge->dropTable('pengembalian');
    }
}
