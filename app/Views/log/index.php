<div class="mb-3">
    <h3>Audit Trail - Log Aktivitas Pengguna</h3>
    <p class="text-muted">Menampilkan seluruh riwayat aktivitas modifikasi data pada sistem arsip secara real-time.</p>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover table-bordered">
            <thead class="table-secondary">
                <tr>
                    <th width="18%">Waktu Kejadian</th>
                    <th width="20%">Nama Eksekutif</th>
                    <th>Aksi Aktivitas</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($logs)): ?>
                    <tr>
                        <td colspan="3" class="text-center text-muted">Belum ada riwayat aktivitas tercatat.</td>
                    </tr>
                <?php endif; ?>
                <?php foreach ($logs as $l): ?>
                    <tr>
                        <td><small class="text-mono"><?= date('d M Y - H:i:s', strtotime($l['waktu'])); ?></small></td>
                        <td><span class="badge bg-dark"><?= $l['nama_lengkap']; ?></span></td>
                        <td><?= $l['aktivitas']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-3">
            <?= $pager ?>
        </div>
    </div>
</div>
