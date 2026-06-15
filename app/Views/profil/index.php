<div class="card col-md-6 mx-auto shadow-sm">
    <div class="card-header bg-dark text-white">
        <h5>Pengaturan Profil & Kredensial Akun</h5>
    </div>
    <div class="card-body">

        <?php if (session()->getFlashdata('success')): ?><div class="alert alert-success"><?= session()->getFlashdata('success') ?></div><?php endif; ?>
        <?php if (session()->getFlashdata('errors')): ?><div class="alert alert-danger"><?= implode(', ', session()->getFlashdata('errors')) ?></div><?php endif; ?>

        <form action="<?= base_url('profil/update') ?>" method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" value="<?= $user['nama_lengkap']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Username (Untuk Login)</label>
                <input type="text" name="username" class="form-control" value="<?= $user['username']; ?>" required>
            </div>
            <div class="mb-3 p-3 bg-light border rounded">
                <label class="form-label text-danger"><b>Ubah Password (Opsional)</b></label>
                <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengganti password">
                <small class="text-muted">Isi kolom ini hanya jika Anda ingin memperbarui password login lama Anda.</small>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
