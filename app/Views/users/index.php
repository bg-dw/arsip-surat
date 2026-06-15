<div class="d-flex justify-content-between mb-3">
    <h3>Daftar Pengguna Sistem (Users)</h3>
    <a href="<?= base_url('users/create') ?>" class="btn btn-primary">+ Tambah Pengguna Baru</a>
</div>

<?php if (session()->getFlashdata('success')): ?><div class="alert alert-success"><?= session()->getFlashdata('success') ?></div><?php endif; ?>
<?php if (session()->getFlashdata('error')): ?><div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div><?php endif; ?>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-striped table-bordered mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>Hak Akses / Role</th>
                    <th class="text-center" width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                    <tr>
                        <td><b><?= $u['nama_lengkap']; ?></b></td>
                        <td><?= $u['username']; ?></td>
                        <td>
                            <span class="badge <?= $u['role'] === 'admin' ? 'bg-danger' : 'bg-info text-dark'; ?>">
                                <?= strtoupper($u['role']); ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <?php if ($u['id'] != session()->get('user_id')): ?>
                                <a href="<?= base_url('users/delete/' . $u['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus pengguna ini?')">Hapus</a>
                            <?php else: ?>
                                <span class="text-muted small">Sedang digunakan</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
