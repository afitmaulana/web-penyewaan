<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KostumSeeder extends Seeder
{
    /**
     * Seeder untuk membuat kostum contoh
     * 
     * Pastikan kategori sudah di-seed terlebih dahulu dengan KategoriSeeder
     */
    public function run()
    {
        // Ambil kategori dari database
        $kategoris = $this->db->table('kategori')->select('id, nama_kategori')->get()->getResultArray();

        // Jika tidak ada kategori, jalankan KategoriSeeder dulu
        if (empty($kategoris)) {
            $kategoriSeeder = new KategoriSeeder(\Config\Database::connect());
            $kategoriSeeder->run();
            $kategoris = $this->db->table('kategori')->select('id, nama_kategori')->get()->getResultArray();
        }

        // Helper untuk cari kategori_id berdasarkan nama
        $getKategoriId = function($nama) use ($kategoris) {
            foreach ($kategoris as $kat) {
                if (strpos(strtolower($kat['nama_kategori']), strtolower($nama)) !== false) {
                    return $kat['id'];
                }
            }
            return $kategoris[0]['id']; // fallback ke kategori pertama
        };

        // Data kostum contoh
        $data = [
            // === KOSTUM TRADISIONAL ===
            [
                'kategori_id'             => $getKategoriId('Tradisional'),
                'nama_kostum'             => 'Kebaya Kutu Baru Merah',
                'deskripsi'               => 'Kebaya tradisional Indonesia warna merah dengan kain songket, lengkap dengan aksesoris',
                'ukuran'                  => 'M',
                'warna'                   => 'Merah',
                'harga_sewa_per_hari'     => 75000,
                'harga_sewa_per_minggu'   => 400000,
                'stok_total'              => 5,
                'stok_tersedia'           => 5,
                'is_active'               => 1,
                'created_at'              => date('Y-m-d H:i:s'),
                'updated_at'              => date('Y-m-d H:i:s'),
            ],
            [
                'kategori_id'             => $getKategoriId('Tradisional'),
                'nama_kostum'             => 'Batik Pria Jogja',
                'deskripsi'               => 'Batik Jogja klasik untuk pria dengan motif khas Yogyakarta',
                'ukuran'                  => 'L',
                'warna'                   => 'Coklat',
                'harga_sewa_per_hari'     => 50000,
                'harga_sewa_per_minggu'   => 300000,
                'stok_total'              => 8,
                'stok_tersedia'           => 8,
                'is_active'               => 1,
                'created_at'              => date('Y-m-d H:i:s'),
                'updated_at'              => date('Y-m-d H:i:s'),
            ],

            // === KOSTUM KARAKTER ===
            [
                'kategori_id'             => $getKategoriId('Karakter'),
                'nama_kostum'             => 'Superman Costume',
                'deskripsi'               => 'Kostum Superman lengkap dengan cape dan aksesoris',
                'ukuran'                  => 'L',
                'warna'                   => 'Biru Merah',
                'harga_sewa_per_hari'     => 60000,
                'harga_sewa_per_minggu'   => 350000,
                'stok_total'              => 4,
                'stok_tersedia'           => 4,
                'is_active'               => 1,
                'created_at'              => date('Y-m-d H:i:s'),
                'updated_at'              => date('Y-m-d H:i:s'),
            ],
            [
                'kategori_id'             => $getKategoriId('Karakter'),
                'nama_kostum'             => 'Batman Costume',
                'deskripsi'               => 'Kostum Batman dengan mask dan cape, perfect untuk cosplay',
                'ukuran'                  => 'XL',
                'warna'                   => 'Hitam Abu-abu',
                'harga_sewa_per_hari'     => 70000,
                'harga_sewa_per_minggu'   => 400000,
                'stok_total'              => 3,
                'stok_tersedia'           => 3,
                'is_active'               => 1,
                'created_at'              => date('Y-m-d H:i:s'),
                'updated_at'              => date('Y-m-d H:i:s'),
            ],

            // === KOSTUM FESTIVAL ===
            [
                'kategori_id'             => $getKategoriId('Festival'),
                'nama_kostum'             => 'Santa Claus Costume',
                'deskripsi'               => 'Kostum Santa Claus lengkap dengan janggut putih dan aksesoris Natal',
                'ukuran'                  => 'L',
                'warna'                   => 'Merah Putih',
                'harga_sewa_per_hari'     => 55000,
                'harga_sewa_per_minggu'   => 320000,
                'stok_total'              => 6,
                'stok_tersedia'           => 6,
                'is_active'               => 1,
                'created_at'              => date('Y-m-d H:i:s'),
                'updated_at'              => date('Y-m-d H:i:s'),
            ],
            [
                'kategori_id'             => $getKategoriId('Festival'),
                'nama_kostum'             => 'Hantu Halloween',
                'deskripsi'               => 'Kostum hantu putih untuk Halloween, simple tapi efektif',
                'ukuran'                  => 'M',
                'warna'                   => 'Putih',
                'harga_sewa_per_hari'     => 35000,
                'harga_sewa_per_minggu'   => 200000,
                'stok_total'              => 10,
                'stok_tersedia'           => 10,
                'is_active'               => 1,
                'created_at'              => date('Y-m-d H:i:s'),
                'updated_at'              => date('Y-m-d H:i:s'),
            ],

            // === KOSTUM PROFESIONAL ===
            [
                'kategori_id'             => $getKategoriId('Profesional'),
                'nama_kostum'             => 'Nurse Costume Putih',
                'deskripsi'               => 'Kostum perawat putih dengan topi dan aksesoris medis',
                'ukuran'                  => 'S',
                'warna'                   => 'Putih',
                'harga_sewa_per_hari'     => 45000,
                'harga_sewa_per_minggu'   => 250000,
                'stok_total'              => 7,
                'stok_tersedia'           => 7,
                'is_active'               => 1,
                'created_at'              => date('Y-m-d H:i:s'),
                'updated_at'              => date('Y-m-d H:i:s'),
            ],
            [
                'kategori_id'             => $getKategoriId('Profesional'),
                'nama_kostum'             => 'Pilot Uniform',
                'deskripsi'               => 'Seragam pilot dengan topi dan sunglasses, professional look',
                'ukuran'                  => 'L',
                'warna'                   => 'Navy Blue',
                'harga_sewa_per_hari'     => 65000,
                'harga_sewa_per_minggu'   => 380000,
                'stok_total'              => 4,
                'stok_tersedia'           => 4,
                'is_active'               => 1,
                'created_at'              => date('Y-m-d H:i:s'),
                'updated_at'              => date('Y-m-d H:i:s'),
            ],

            // === KOSTUM TEMA PESTA ===
            [
                'kategori_id'             => $getKategoriId('Tema'),
                'nama_kostum'             => 'Pirate Costume',
                'deskripsi'               => 'Kostum bajak laut dengan topi, patch mata, dan pedang mainan',
                'ukuran'                  => 'M',
                'warna'                   => 'Hitam',
                'harga_sewa_per_hari'     => 50000,
                'harga_sewa_per_minggu'   => 300000,
                'stok_total'              => 5,
                'stok_tersedia'           => 5,
                'is_active'               => 1,
                'created_at'              => date('Y-m-d H:i:s'),
                'updated_at'              => date('Y-m-d H:i:s'),
            ],
            [
                'kategori_id'             => $getKategoriId('Tema'),
                'nama_kostum'             => 'Disco Costume 70s',
                'deskripsi'               => 'Kostum disco tahun 70an dengan warna cerah dan berkilau',
                'ukuran'                  => 'M',
                'warna'                   => 'Emas',
                'harga_sewa_per_hari'     => 55000,
                'harga_sewa_per_minggu'   => 320000,
                'stok_total'              => 6,
                'stok_tersedia'           => 6,
                'is_active'               => 1,
                'created_at'              => date('Y-m-d H:i:s'),
                'updated_at'              => date('Y-m-d H:i:s'),
            ],

            // === KOSTUM ANAK-ANAK ===
            [
                'kategori_id'             => $getKategoriId('Anak'),
                'nama_kostum'             => 'Mickey Mouse Anak',
                'deskripsi'               => 'Kostum Mickey Mouse untuk anak-anak, lucu dan aman',
                'ukuran'                  => 'S',
                'warna'                   => 'Merah Hitam',
                'harga_sewa_per_hari'     => 40000,
                'harga_sewa_per_minggu'   => 230000,
                'stok_total'              => 5,
                'stok_tersedia'           => 5,
                'is_active'               => 1,
                'created_at'              => date('Y-m-d H:i:s'),
                'updated_at'              => date('Y-m-d H:i:s'),
            ],
            [
                'kategori_id'             => $getKategoriId('Anak'),
                'nama_kostum'             => 'Spiderman Anak',
                'deskripsi'               => 'Kostum Spiderman untuk anak dengan warna cerah dan nyaman',
                'ukuran'                  => 'S',
                'warna'                   => 'Merah Biru',
                'harga_sewa_per_hari'     => 45000,
                'harga_sewa_per_minggu'   => 260000,
                'stok_total'              => 5,
                'stok_tersedia'           => 5,
                'is_active'               => 1,
                'created_at'              => date('Y-m-d H:i:s'),
                'updated_at'              => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert data
        foreach ($data as $row) {
            $this->db->table('kostum')->insert($row);
        }

        echo "✅ Kostum seeder berhasil dijalankan!\n";
        echo "Total kostum yang ditambahkan: " . count($data) . "\n";
    }
}
