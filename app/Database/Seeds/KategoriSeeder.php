<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Seeder untuk membuat kategori kostum contoh
     */
    public function run()
    {
        // Data kategori contoh
        $data = [
            [
                'nama_kategori' => 'Kostum Tradisional',
                'deskripsi'     => 'Kostum tradisional Indonesia seperti Batik, Kebaya, Beskap, dan lainnya',
                'is_active'     => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kategori' => 'Kostum Karakter',
                'deskripsi'     => 'Kostum karakter dari film, anime, game, dan tokoh populer lainnya',
                'is_active'     => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kategori' => 'Kostum Festival',
                'deskripsi'     => 'Kostum untuk perayaan festival seperti Natal, Halloween, Tahun Baru, dan lainnya',
                'is_active'     => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kategori' => 'Kostum Profesional',
                'deskripsi'     => 'Kostum untuk pekerjaan atau profesi tertentu seperti Nurse, Pilot, Police, dan lainnya',
                'is_active'     => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kategori' => 'Kostum Tema Pesta',
                'deskripsi'     => 'Kostum dengan tema khusus untuk pesta seperti Pirate, Western, Disco, dan lainnya',
                'is_active'     => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kategori' => 'Kostum Anak-Anak',
                'deskripsi'     => 'Kostum dengan ukuran anak-anak untuk berbagai karakter dan tema',
                'is_active'     => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert data
        foreach ($data as $row) {
            $this->db->table('kategori')->insert($row);
        }

        echo "✅ Kategori seeder berhasil dijalankan!\n";
        echo "Total kategori yang ditambahkan: " . count($data) . "\n";
    }
}
