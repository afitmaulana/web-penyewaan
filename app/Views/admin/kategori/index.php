<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2><?= esc($title) ?></h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="<?= route_to('kategori_create') ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Kategori
            </a>
        </div>
    </div>

    <!-- Alert Messages -->
    <?php if (session()->has('message')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> <?= esc(session('message')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> <?= esc(session('error')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Tabel Kategori -->
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th width="5%">#</th>
                        <th width="35%">Nama Kategori</th>
                        <th width="40%">Deskripsi</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($kategori)): ?>
                        <?php $no = 1; foreach ($kategori as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <strong><?= esc($row['nama_kategori']) ?></strong>
                                </td>
                                <td>
                                    <?= esc(substr($row['deskripsi'] ?? '-', 0, 60)) ?>
                                    <?php if (strlen($row['deskripsi'] ?? '') > 60): ?>...<?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= route_to('kategori_edit', $row['kategori_id']) ?>" 
                                       class="btn btn-sm btn-info" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="<?= route_to('kategori_delete', $row['kategori_id']) ?>" 
                                          style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">
                                <i class="fas fa-inbox"></i> Belum ada kategori
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
