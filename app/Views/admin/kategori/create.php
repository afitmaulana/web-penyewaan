<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><?= esc($title) ?></h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= route_to('kategori_store') ?>">
                        <?= csrf_field() ?>

                        <!-- Nama Kategori -->
                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control <?= (isset($validation) && $validation->hasError('nama_kategori')) ? 'is-invalid' : '' ?>" 
                                   id="nama_kategori" 
                                   name="nama_kategori" 
                                   value="<?= old('nama_kategori') ?>" 
                                   placeholder="Contoh: Pria, Wanita, Anak-anak">
                            <?php if (isset($validation) && $validation->hasError('nama_kategori')): ?>
                                <div class="invalid-feedback d-block">
                                    <?= $validation->getError('nama_kategori') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" 
                                      id="deskripsi" 
                                      name="deskripsi" 
                                      rows="4" 
                                      placeholder="Deskripsi kategori kostum..."><?= old('deskripsi') ?></textarea>
                            <small class="form-text text-muted">Opsional, maksimal 500 karakter</small>
                        </div>

                        <!-- Buttons -->
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <a href="<?= route_to('kategori_index') ?>" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
