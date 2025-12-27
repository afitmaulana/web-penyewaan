<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><?= esc($title) ?></h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= route_to('kostum_store') ?>" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <!-- Row 1: Nama & Kategori -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_kostum" class="form-label">Nama Kostum <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control <?= (isset($validation) && $validation->hasError('nama_kostum')) ? 'is-invalid' : '' ?>" 
                                       id="nama_kostum" 
                                       name="nama_kostum" 
                                       value="<?= old('nama_kostum') ?>" 
                                       placeholder="Contoh: Kostum Pengantin">
                                <?php if (isset($validation) && $validation->hasError('nama_kostum')): ?>
                                    <div class="invalid-feedback d-block">
                                        <?= $validation->getError('nama_kostum') ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="kategori_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                                <select class="form-select <?= (isset($validation) && $validation->hasError('kategori_id')) ? 'is-invalid' : '' ?>" 
                                        id="kategori_id" 
                                        name="kategori_id">
                                    <option value="">-- Pilih Kategori --</option>
                                    <?php foreach ($kategori as $kat): ?>
                                        <option value="<?= $kat['kategori_id'] ?>" 
                                                <?= old('kategori_id') == $kat['kategori_id'] ? 'selected' : '' ?>>
                                            <?= esc($kat['nama_kategori']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset($validation) && $validation->hasError('kategori_id')): ?>
                                    <div class="invalid-feedback d-block">
                                        <?= $validation->getError('kategori_id') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Row 2: Ukuran & Stok -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="ukuran" class="form-label">Ukuran <span class="text-danger">*</span></label>
                                <select class="form-select <?= (isset($validation) && $validation->hasError('ukuran')) ? 'is-invalid' : '' ?>" 
                                        id="ukuran" 
                                        name="ukuran">
                                    <option value="">-- Pilih Ukuran --</option>
                                    <option value="XS" <?= old('ukuran') === 'XS' ? 'selected' : '' ?>>XS</option>
                                    <option value="S" <?= old('ukuran') === 'S' ? 'selected' : '' ?>>S</option>
                                    <option value="M" <?= old('ukuran') === 'M' ? 'selected' : '' ?>>M</option>
                                    <option value="L" <?= old('ukuran') === 'L' ? 'selected' : '' ?>>L</option>
                                    <option value="XL" <?= old('ukuran') === 'XL' ? 'selected' : '' ?>>XL</option>
                                    <option value="XXL" <?= old('ukuran') === 'XXL' ? 'selected' : '' ?>>XXL</option>
                                </select>
                                <?php if (isset($validation) && $validation->hasError('ukuran')): ?>
                                    <div class="invalid-feedback d-block">
                                        <?= $validation->getError('ukuran') ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="stok" class="form-label">Stok <span class="text-danger">*</span></label>
                                <input type="number" 
                                       class="form-control <?= (isset($validation) && $validation->hasError('stok')) ? 'is-invalid' : '' ?>" 
                                       id="stok" 
                                       name="stok" 
                                       value="<?= old('stok') ?? 0 ?>" 
                                       min="0" 
                                       placeholder="Jumlah stok">
                                <?php if (isset($validation) && $validation->hasError('stok')): ?>
                                    <div class="invalid-feedback d-block">
                                        <?= $validation->getError('stok') ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="harga_per_hari" class="form-label">Harga per Hari <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" 
                                           class="form-control <?= (isset($validation) && $validation->hasError('harga_per_hari')) ? 'is-invalid' : '' ?>" 
                                           id="harga_per_hari" 
                                           name="harga_per_hari" 
                                           value="<?= old('harga_per_hari') ?>" 
                                           min="0" 
                                           step="1000" 
                                           placeholder="50000">
                                </div>
                                <?php if (isset($validation) && $validation->hasError('harga_per_hari')): ?>
                                    <div class="invalid-feedback d-block">
                                        <?= $validation->getError('harga_per_hari') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Row 3: Deskripsi -->
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" 
                                      id="deskripsi" 
                                      name="deskripsi" 
                                      rows="3" 
                                      placeholder="Deskripsi detail kostum..."><?= old('deskripsi') ?></textarea>
                            <small class="form-text text-muted">Opsional, maksimal 500 karakter</small>
                        </div>

                        <!-- Row 4: Upload Foto -->
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto Kostum <span class="text-danger">*</span></label>
                            <input type="file" 
                                   class="form-control <?= (isset($validation) && $validation->hasError('foto')) ? 'is-invalid' : '' ?>" 
                                   id="foto" 
                                   name="foto" 
                                   accept="image/jpg,image/jpeg,image/png" 
                                   onchange="previewImage(event)">
                            <small class="form-text text-muted">Format: JPG, JPEG, PNG (Max 2MB)</small>
                            <div id="image-preview" class="mt-2"></div>
                            <?php if (isset($validation) && $validation->hasError('foto')): ?>
                                <div class="invalid-feedback d-block">
                                    <?= $validation->getError('foto') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Buttons -->
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <a href="<?= route_to('kostum_index') ?>" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('image-preview');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = '<img src="' + e.target.result + '" style="max-width: 200px; margin-top: 10px;" class="img-thumbnail">';
        };
        reader.readAsDataURL(file);
    }
}
</script>
<?= $this->endSection() ?>
