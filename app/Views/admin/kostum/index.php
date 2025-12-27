<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2><?= esc($title) ?></h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="<?= route_to('kostum_create') ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Kostum
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

    <!-- Tabel Kostum -->
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th width="5%">#</th>
                        <th width="8%">Foto</th>
                        <th width="18%">Nama Kostum</th>
                        <th width="12%">Kategori</th>
                        <th width="8%">Ukuran</th>
                        <th width="8%">Stok</th>
                        <th width="12%">Harga/Hari</th>
                        <th width="8%">Status</th>
                        <th width="21%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($kostum)): ?>
                        <?php $no = 1; foreach ($kostum as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <?php if (!empty($row['foto_url']) && file_exists(ROOTPATH . 'public/uploads/kostum/' . $row['foto_url'])): ?>
                                        <img src="<?= base_url('uploads/kostum/' . $row['foto_url']) ?>" 
                                             alt="<?= esc($row['nama_kostum']) ?>" 
                                             style="max-width: 50px; height: auto;">
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <strong><?= esc($row['nama_kostum']) ?></strong>
                                </td>
                                <td><?= esc($row['nama_kategori']) ?></td>
                                <td><?= esc($row['ukuran']) ?></td>
                                <td>
                                    <span class="badge bg-<?= $row['stok_tersedia'] > 0 ? 'success' : 'danger' ?>">
                                        <?= $row['stok_tersedia'] ?>
                                    </span>
                                </td>
                                <td>
                                    <strong>Rp <?= number_format($row['harga_sewa_per_hari'], 0, ',', '.') ?></strong>
                                </td>
                                <td>
                                    <?php 
                                        $status = $row['stok_tersedia'] > 0 ? 'Tersedia' : 'Habis';
                                        $badgeClass = $status === 'Tersedia' ? 'success' : 'danger';
                                    ?>
                                    <span class="badge bg-<?= $badgeClass ?>">
                                        <?= esc($status) ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?= route_to('kostum_edit', $row['id']) ?>" 
                                       class="btn btn-sm btn-info" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="<?= route_to('kostum_delete', $row['id']) ?>" 
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
                            <td colspan="9" class="text-center py-4 text-muted">
                                <i class="fas fa-inbox"></i> Belum ada kostum
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
