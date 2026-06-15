<div class="card col-md-6 mx-auto shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5>Form Registrasi Pengguna Baru</h5>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('errors')): ?><div class="alert alert-danger"><?= implode(', ', session()->getFlashdata('errors')) ?></div><?php endif; ?>

        <form action="<?= base_url('users/store') ?>" method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" value="<?= old('nama_lengkap') ?>" required placeholder="Masukkan nama asli pegawai">
            </div>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" value="<?= old('username') ?>" required placeholder="Contoh: staff_baru">
            </div>
            <div class="mb-3">
                <label class="form-label">Password Utama</label>
                <input type="password" name="password" class="form-control" required placeholder="Minimal 6 karakter">
            </div>
            <div class="mb-3">
                <label class="form-label">Role Akses</label>
                <select name="role" class="form-select" required>
                    <option value="staff">Staff (Hanya Kelola Surat & Kategori)</option>
                    <option value="admin">Administrator (Akses Penuh + Kelola User)</option>
                </select>
            </div>
            <div class="d-flex justify-content-between">
                <a href="<?= base_url('users') ?>" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Daftarkan Akun</button>
            </div>
        </form>
    </div>
</div>
