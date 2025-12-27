<?php

namespace App\Models;

use CodeIgniter\Model;

class KostumModel extends Model
{
    protected $table            = 'kostum';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    // Dates
    protected $allowedFields = [
        'nama_kostum',
        'kategori_id',
        'ukuran',
        'warna',
        'stok_tersedia',
        'stok_total',
        'harga_sewa_per_hari',
        'harga_sewa_per_minggu',
        'deskripsi',
        'foto_url',
        'is_active',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'nama_kostum'           => 'required|string|min_length[3]|max_length[100]',
        'kategori_id'           => 'required|integer|greater_than[0]',
        'ukuran'                => 'required|string|in_list[XS,S,M,L,XL,XXL]',
        'warna'                 => 'permit_empty|string|max_length[50]',
        'stok'                  => 'required|integer|greater_than_equal_to[0]',
        'harga_per_hari'        => 'required|decimal|greater_than[0]',
        'harga_per_minggu'      => 'permit_empty|decimal|greater_than_equal_to[0]',
        'deskripsi'             => 'permit_empty|string|max_length[500]',
        'foto'                  => 'uploaded[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,2048]',
    ];

    protected $validationMessages   = [
        'nama_kostum' => [
            'required'      => 'Nama kostum harus diisi',
            'min_length'    => 'Nama kostum minimal 3 karakter',
            'max_length'    => 'Nama kostum maksimal 100 karakter',
            'string'        => 'Nama kostum harus berupa teks',
        ],
        'kategori_id' => [
            'required'      => 'Kategori harus dipilih',
            'greater_than'  => 'Kategori tidak valid',
        ],
        'ukuran' => [
            'required'      => 'Ukuran harus dipilih',
            'in_list'       => 'Ukuran tidak valid',
        ],
        'stok' => [
            'required'      => 'Stok harus diisi',
            'integer'       => 'Stok harus berupa angka',
            'greater_than_equal_to' => 'Stok tidak boleh negatif',
        ],
        'harga_per_hari' => [
            'required'      => 'Harga per hari harus diisi',
            'decimal'       => 'Harga harus berupa angka desimal',
            'greater_than'  => 'Harga harus lebih dari 0',
        ],
        'deskripsi' => [
            'max_length'    => 'Deskripsi maksimal 500 karakter',
        ],
        'foto' => [
            'uploaded'      => 'Foto harus diunggah',
            'mime_in'       => 'Foto harus JPG, JPEG, atau PNG',
            'max_size'      => 'Ukuran foto maksimal 2MB',
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
     * Get semua kostum dengan kategori
     */
    public function getAllKostum()
    {
        return $this->select('kostum.*, kategori.nama_kategori')
                    ->join('kategori', 'kategori.id = kostum.kategori_id')
                    ->orderBy('kostum.nama_kostum', 'ASC')
                    ->findAll();
    }

    /**
     * Get kostum by ID dengan kategori
     */
    public function getKostumById($id)
    {
        return $this->select('kostum.*, kategori.nama_kategori')
                    ->join('kategori', 'kategori.id = kostum.kategori_id')
                    ->find($id);
    }

    /**
     * Get kostum by kategori ID
     */
    public function getKostumByKategori($kategoriId)
    {
        return $this->where('kategori_id', $kategoriId)
                    ->orderBy('nama_kostum', 'ASC')
                    ->findAll();
    }

    /**
     * Update status otomatis berdasarkan stok
     */
    public function updateStatusByStok($kostumId)
    {
        $kostum = $this->find($kostumId);
        if (!$kostum) {
            return false;
        }

        $status = ($kostum['stok'] > 0) ? 'Tersedia' : 'Habis';

        return $this->update($kostumId, ['status' => $status]);
    }

    /**
     * Handle upload foto
     */
    public function uploadFoto($file)
    {
        if (!$file->isValid()) {
            return null;
        }

        $nama_file = $file->getRandomName();
        $file->move(ROOTPATH . 'public/uploads/kostum', $nama_file);

        return $nama_file;
    }

    /**
     * Delete foto
     */
    public function deleteFoto($filename)
    {
        $path = ROOTPATH . 'public/uploads/kostum/' . $filename;
        if (file_exists($path)) {
            unlink($path);
            return true;
        }
        return false;
    }

    /**
     * Get validation rules untuk update (tanpa foto required)
     */
    public function getUpdateValidationRules()
    {
        $rules = $this->validationRules;
        // Ubah foto menjadi optional untuk update
        $rules['foto'] = 'permit_empty|mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,2048]';
        return $rules;
    }

    /**
     * Get validation rules untuk create (dengan foto required)
     */
    public function getValidationRules(array $options = []): array
    {
        return $this->validationRules;
    }
}
