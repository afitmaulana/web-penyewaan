<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KostumModel;
use App\Models\KategoriModel;

class KostumController extends BaseController
{
    protected $kostumModel;
    protected $kategoriModel;
    protected $validation;

    public function __construct()
    {
        $this->kostumModel = new KostumModel();
        $this->kategoriModel = new KategoriModel();
        $this->validation = \Config\Services::validation();
    }

    /**
     * Display list of kostum
     */
    public function index()
    {
        $data = [
            'title'   => 'Manajemen Kostum',
            'kostum'  => $this->kostumModel->getAllKostum(),
        ];

        return view('admin/kostum/index', $data);
    }

    /**
     * Show form create kostum
     */
    public function create()
    {
        $data = [
            'title'      => 'Tambah Kostum',
            'kategori'   => $this->kategoriModel->getAllKategori(),
            'validation' => $this->validation,
        ];

        return view('admin/kostum/create', $data);
    }

    /**
     * Store kostum ke database
     */
    public function store()
    {
        // Validasi input (dengan foto required untuk create)
        if (!$this->validate($this->kostumModel->getValidationRules())) {
            return redirect()->back()
                           ->withInput()
                           ->with('validation', $this->validation);
        }

        // Handle upload foto
        $file = $this->request->getFile('foto');
        $fotoName = $this->kostumModel->uploadFoto($file);

        if (!$fotoName) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Gagal mengunggah foto');
        }

        // Prepare data
        $stok = (int) $this->request->getPost('stok');

        $data = [
            'nama_kostum'           => $this->request->getPost('nama_kostum'),
            'kategori_id'           => (int) $this->request->getPost('kategori_id'),
            'ukuran'                => $this->request->getPost('ukuran'),
            'warna'                 => $this->request->getPost('warna') ?? '',
            'stok_tersedia'         => $stok,
            'stok_total'            => $stok,
            'harga_sewa_per_hari'   => (float) $this->request->getPost('harga_per_hari'),
            'harga_sewa_per_minggu' => (float) $this->request->getPost('harga_per_minggu') ?? 0,
            'deskripsi'             => $this->request->getPost('deskripsi'),
            'foto_url'              => $fotoName,
            'is_active'             => 1,
        ];

        // Insert
        if ($this->kostumModel->insert($data)) {
            return redirect()->to(route_to('kostum_index'))
                           ->with('message', 'Kostum berhasil ditambahkan');
        } else {
            // Hapus foto jika insert gagal
            $this->kostumModel->deleteFoto($fotoName);
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Gagal menambahkan kostum');
        }
    }

    /**
     * Show form edit kostum
     */
    public function edit($id = null)
    {
        $kostum = $this->kostumModel->getKostumById($id);

        if (!$kostum) {
            return redirect()->to(route_to('kostum_index'))
                           ->with('error', 'Kostum tidak ditemukan');
        }

        $data = [
            'title'      => 'Edit Kostum',
            'kostum'     => $kostum,
            'kategori'   => $this->kategoriModel->getAllKategori(),
            'validation' => $this->validation,
        ];

        return view('admin/kostum/edit', $data);
    }

    /**
     * Update kostum
     */
    public function update($id = null)
    {
        $kostum = $this->kostumModel->getKostumById($id);

        if (!$kostum) {
            return redirect()->to(route_to('kostum_index'))
                           ->with('error', 'Kostum tidak ditemukan');
        }

        // Validasi input (foto optional untuk update)
        $validationRules = $this->kostumModel->getUpdateValidationRules();
        if (!$this->validate($validationRules)) {
            return redirect()->back()
                           ->withInput()
                           ->with('validation', $this->validation);
        }

        // Handle foto jika ada upload baru
        $file = $this->request->getFile('foto');
        $fotoName = $kostum['foto_url'];

        if ($file && $file->isValid()) {
            // Hapus foto lama
            $this->kostumModel->deleteFoto($kostum['foto_url']);
            // Upload foto baru
            $fotoName = $this->kostumModel->uploadFoto($file);
            if (!$fotoName) {
                return redirect()->back()
                               ->withInput()
                               ->with('error', 'Gagal mengunggah foto');
            }
        }

        // Prepare data
        $stok = (int) $this->request->getPost('stok');

        $data = [
            'nama_kostum'           => $this->request->getPost('nama_kostum'),
            'kategori_id'           => (int) $this->request->getPost('kategori_id'),
            'ukuran'                => $this->request->getPost('ukuran'),
            'warna'                 => $this->request->getPost('warna') ?? '',
            'stok_tersedia'         => $stok,
            'stok_total'            => $stok,
            'harga_sewa_per_hari'   => (float) $this->request->getPost('harga_per_hari'),
            'harga_sewa_per_minggu' => (float) $this->request->getPost('harga_per_minggu') ?? 0,
            'deskripsi'             => $this->request->getPost('deskripsi'),
            'foto_url'              => $fotoName,
            'is_active'             => 1,
        ];

        // Update
        if ($this->kostumModel->update($id, $data)) {
            return redirect()->to(route_to('kostum_index'))
                           ->with('message', 'Kostum berhasil diperbarui');
        } else {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Gagal memperbarui kostum');
        }
    }

    /**
     * Delete kostum
     */
    public function delete($id = null)
    {
        $kostum = $this->kostumModel->getKostumById($id);

        if (!$kostum) {
            return redirect()->to(route_to('kostum_index'))
                           ->with('error', 'Kostum tidak ditemukan');
        }

        // Hapus foto
        $this->kostumModel->deleteFoto($kostum['foto_url']);

        // Delete
        if ($this->kostumModel->delete($id)) {
            return redirect()->to(route_to('kostum_index'))
                           ->with('message', 'Kostum berhasil dihapus');
        } else {
            return redirect()->to(route_to('kostum_index'))
                           ->with('error', 'Gagal menghapus kostum');
        }
    }
}
