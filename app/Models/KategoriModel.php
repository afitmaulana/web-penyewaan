<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table            = 'kategori';
    protected $primaryKey       = 'kategori_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    // Dates
    protected $allowedFields = ['nama_kategori', 'deskripsi', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'nama_kategori' => 'required|string|min_length[3]|max_length[100]|is_unique[kategori.nama_kategori,kategori_id,{kategori_id}]',
        'deskripsi'     => 'permit_empty|string|max_length[500]',
    ];
    protected $validationMessages   = [
        'nama_kategori' => [
            'required'      => 'Nama kategori harus diisi',
            'min_length'    => 'Nama kategori minimal 3 karakter',
            'max_length'    => 'Nama kategori maksimal 100 karakter',
            'is_unique'     => 'Nama kategori sudah ada, gunakan nama lain',
            'string'        => 'Nama kategori harus berupa teks',
        ],
        'deskripsi' => [
            'max_length'    => 'Deskripsi maksimal 500 karakter',
            'string'        => 'Deskripsi harus berupa teks',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Get semua kategori
     */
    public function getAllKategori()
    {
        return $this->orderBy('nama_kategori', 'ASC')->findAll();
    }

    /**
     * Get kategori by ID
     */
    public function getKategoriById($id)
    {
        return $this->find($id);
    }

    /**
     * Cek apakah kategori digunakan di kostum
     */
    public function isKategoriUsed($kategoriId)
    {
        $db = \Config\Database::connect();
        $result = $db->table('kostum')
                     ->where('kategori_id', $kategoriId)
                     ->countAllResults();
        return $result > 0;
    }

    /**
     * Get validation rules
     */
    public function getValidationRules(array $options = []): array
    {
        return $this->validationRules;
    }
}
