<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKostumTable extends Migration
{
    public function up()
    {
        // Buat tabel kostum
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kategori_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'nama_kostum' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'ukuran' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'warna' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'harga_sewa_per_hari' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'harga_sewa_per_minggu' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => true,
            ],
            'stok_tersedia' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'stok_total' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'foto_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'is_active' => [
                'type'    => 'TINYINT',
                'default' => 1,
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

        // Add foreign key ke kategori
        $this->forge->addForeignKey('kategori_id', 'kategori', 'id', 'CASCADE', 'CASCADE');

        // Add indexes
        $this->forge->addKey('kategori_id');
        $this->forge->addKey('is_active');
        $this->forge->addKey('nama_kostum');

        // Buat tabel
        $this->forge->createTable('kostum');
    }

    public function down()
    {
        // Drop tabel kostum
        $this->forge->dropTable('kostum');
    }
}
