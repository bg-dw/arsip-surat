<div class="d-flex justify-content-between mb-3">
    <h3>Daftar Surat</h3><a href="/surat/create" class="btn btn-primary">+ Unggah Surat Baru</a>
</div>
<?php if (session()->getFlashdata('success')): ?><div class="alert alert-success"><?= session()->getFlashdata('success') ?></div><?php endif; ?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No Surat</th>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($surat as $s): ?><tr>
                <td><?= $s['nomor_surat']; ?></td>
                <td><?= $s['judul_surat']; ?></td>
                <td><?= $s['nama_kategori']; ?></td>
                <td><?= $s['tanggal_surat']; ?></td>
                <td>
                    <a href="/surat/download/<?= $s['id']; ?>" class="btn btn-sm btn-success">Download</a> <a href="/surat/delete/<?= $s['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')">Hapus</a>
                </td>
            </tr><?php endforeach; ?>
    </tbody>
</table>
