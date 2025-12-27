<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Seeder untuk membuat admin default
     * 
     * Password default: admin123 (di-hash dengan bcrypt)
     * Email: admin@rentalkosiium.com
     */
    public function run()
    {
        // Data admin default
        $data = [
            [
                'nama_lengkap'  => 'Admin Master',
                'email'         => 'admin@rentalkosiium.com',
                'password'      => password_hash('admin123', PASSWORD_BCRYPT),
                'nomor_hp'      => '081234567890',
                'alamat'        => 'Jl. Jendral Sudirman No. 1, Jakarta',
                'kota'          => 'Jakarta',
                'provinsi'      => 'DKI Jakarta',
                'kode_pos'      => '12960',
                'role'          => 'admin',
                'is_active'     => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nama_lengkap'  => 'Admin Operasional',
                'email'         => 'operasional@rentalkosiium.com',
                'password'      => password_hash('admin123', PASSWORD_BCRYPT),
                'nomor_hp'      => '081234567891',
                'alamat'        => 'Jl. Jendral Sudirman No. 2, Jakarta',
                'kota'          => 'Jakarta',
                'provinsi'      => 'DKI Jakarta',
                'kode_pos'      => '12960',
                'role'          => 'admin',
                'is_active'     => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert data
        foreach ($data as $row) {
            $this->db->table('users')->insert($row);
        }

        echo "✅ Admin seeder berhasil dijalankan!\n";
        echo "Email: admin@rentalkosiium.com\n";
        echo "Email: operasional@rentalkosiium.com\n";
        echo "Password: admin123\n";
    }
}
