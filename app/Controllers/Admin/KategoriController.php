<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class KategoriController extends BaseController
{
    protected $kategoriModel;
    protected $validation;

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
        $this->validation = \Config\Services::validation();
    }

    /**
     * Display list of kategori
     */
    public function index()
    {
        $data = [
            'title'      => 'Manajemen Kategori',
            'kategori'   => $this->kategoriModel->getAllKategori(),
        ];

        return view('admin/kategori/index', $data);
    }

    /**
     * Show form create kategori
     */
    public function create()
    {
        $data = [
            'title'   => 'Tambah Kategori',
            'validation' => $this->validation,
        ];

        return view('admin/kategori/create', $data);
    }

    /**
     * Store kategori ke database
     */
    public function store()
    {
        // Validasi input
        if (!$this->validate($this->kategoriModel->getValidationRules())) {
            return redirect()->back()
                           ->withInput()
                           ->with('validation', $this->validation);
        }

        // Prepare data
        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'deskripsi'     => $this->request->getPost('deskripsi'),
        ];

        // Insert
        if ($this->kategoriModel->insert($data)) {
            return redirect()->to(route_to('kategori_index'))
                           ->with('message', 'Kategori berhasil ditambahkan');
        } else {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Gagal menambahkan kategori');
        }
    }

    /**
     * Show form edit kategori
     */
    public function edit($id = null)
    {
        $kategori = $this->kategoriModel->getKategoriById($id);

        if (!$kategori) {
            return redirect()->to(route_to('kategori_index'))
                           ->with('error', 'Kategori tidak ditemukan');
        }

        $data = [
            'title'      => 'Edit Kategori',
            'kategori'   => $kategori,
            'validation' => $this->validation,
        ];

        return view('admin/kategori/edit', $data);
    }

    /**
     * Update kategori
     */
    public function update($id = null)
    {
        $kategori = $this->kategoriModel->getKategoriById($id);

        if (!$kategori) {
            return redirect()->to(route_to('kategori_index'))
                           ->with('error', 'Kategori tidak ditemukan');
        }

        // Validasi input
        if (!$this->validate($this->kategoriModel->getValidationRules())) {
            return redirect()->back()
                           ->withInput()
                           ->with('validation', $this->validation);
        }

        // Prepare data
        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'deskripsi'     => $this->request->getPost('deskripsi'),
        ];

        // Update
        if ($this->kategoriModel->update($id, $data)) {
            return redirect()->to(route_to('kategori_index'))
                           ->with('message', 'Kategori berhasil diperbarui');
        } else {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Gagal memperbarui kategori');
        }
    }

    /**
     * Delete kategori
     */
    public function delete($id = null)
    {
        $kategori = $this->kategoriModel->getKategoriById($id);

        if (!$kategori) {
            return redirect()->to(route_to('kategori_index'))
                           ->with('error', 'Kategori tidak ditemukan');
        }

        // Cek apakah kategori masih digunakan
        if ($this->kategoriModel->isKategoriUsed($id)) {
            return redirect()->to(route_to('kategori_index'))
                           ->with('error', 'Kategori masih digunakan oleh kostum, tidak bisa dihapus');
        }

        // Delete
        if ($this->kategoriModel->delete($id)) {
            return redirect()->to(route_to('kategori_index'))
                           ->with('message', 'Kategori berhasil dihapus');
        } else {
            return redirect()->to(route_to('kategori_index'))
                           ->with('error', 'Gagal menghapus kategori');
        }
    }
}
