<div class="card col-md-6 mx-auto">
    <div class="card-header bg-primary text-white">
        <h5>Tambah Kategori</h5>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('errors')): ?><div class="alert alert-danger"><?= implode(', ', session()->getFlashdata('errors')) ?></div><?php endif; ?>

        <form action="<?= base_url('kategori/store') ?>" method="POST">
            <div class="mb-3">
                <label>Nama Kategori</label>
                <input type="text" name="nama_kategori" class="form-control" required placeholder="Contoh: Surat Perjanjian Kerja">
            </div>
            <div class="mb-3">
                <label>Deskripsi Singkat</label>
                <textarea name="deskripsi" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Kategori</button>
            <a href="<?= base_url('kategori') ?>" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
