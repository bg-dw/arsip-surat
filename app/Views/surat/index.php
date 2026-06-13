<div class="d-flex justify-content-between mb-3">
    <h3>Daftar Surat</h3><a href="<?= base_url('surat/create') ?>" class="btn btn-primary">+ Unggah Surat Baru</a>
</div>
<?php if (session()->getFlashdata('error')): ?><div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div><?php endif; ?>
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
                    <a href="<?= base_url('surat/download/' . $s['id']) ?>" class="btn btn-sm btn-success">Download</a> <a href="<?= base_url('surat/delete/' . $s['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')">Hapus</a>
                </td>
            </tr><?php endforeach; ?>
    </tbody>
</table>
