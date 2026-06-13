<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5>Form Upload Hasil Scan Surat</h5>
            </div>
            <div class="card-body">

                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                                <li><?= $error ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('surat/store') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label class="form-label">Nomor Surat</label>
                        <input type="text" name="nomor_surat" class="form-control" value="<?= old('nomor_surat') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Judul / Perihal Surat</label>
                        <input type="text" name="judul_surat" class="form-control" value="<?= old('judul_surat') ?>" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Surat Resmi</label>
                            <input type="date" name="tanggal_surat" class="form-control" value="<?= old('tanggal_surat') ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="kategori_id" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                <?php foreach ($kategori as $k): ?>
                                    <option value="<?= $k['id']; ?>" <?= old('kategori_id') == $k['id'] ? 'selected' : '' ?>><?= $k['nama_kategori']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pilih Berkas Scan (PDF, JPG, PNG - Maks 5MB)</label>
                        <input type="file" name="file_scan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan Tambahan (Opsional)</label>
                        <textarea name="keterangan" class="form-control" rows="3"><?= old('keterangan') ?></textarea>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url('surat') ?>" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Mulai Arsipkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
