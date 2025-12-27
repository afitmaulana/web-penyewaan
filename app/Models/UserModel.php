<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    // Fields
    protected $allowedFields = [
        'nama_lengkap',
        'email',
        'password',
        'nomor_hp',
        'alamat',
        'kota',
        'provinsi',
        'kode_pos',
        'role',
        'is_active',
        'last_login'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation Rules
    protected $validationRules = [
        'email'          => 'required|valid_email|is_unique[users.email]',
        'password'       => 'required|min_length[8]',
        'nama_lengkap'   => 'required|min_length[3]|max_length[100]',
        'nomor_hp'       => 'required|min_length[10]|max_length[15]',
        'alamat'         => 'required|min_length[10]',
    ];

    protected $validationMessages = [
        'email' => [
            'required' => 'Email harus diisi',
            'valid_email' => 'Format email tidak valid',
            'is_unique' => 'Email sudah terdaftar'
        ],
        'password' => [
            'required' => 'Password harus diisi',
            'min_length' => 'Password minimal 8 karakter'
        ]
    ];

    /**
     * Find user by email
     */
    public function findByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    /**
     * Find active user by email
     */
    public function findActiveByEmail($email)
    {
        return $this->where('email', $email)
                    ->where('is_active', 1)
                    ->first();
    }

    /**
     * Update last login
     */
    public function updateLastLogin($userId)
    {
        return $this->update($userId, [
            'last_login' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Register new user (pelanggan only)
     */
    public function register($data)
    {
        // Add role as pelanggan
        $data['role'] = 'pelanggan';
        $data['is_active'] = 1;
        
        // Hash password
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        
        return $this->insert($data);
    }

    /**
     * Verify password
     */
    public static function verifyPassword($rawPassword, $hashedPassword)
    {
        return password_verify($rawPassword, $hashedPassword);
    }
}
