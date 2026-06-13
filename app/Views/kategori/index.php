<div class="d-flex justify-content-between mb-3">
    <h3>Daftar Kategori Jenis Surat</h3>
    <a href="<?= base_url('kategori/create') ?>" class="btn btn-primary">+ Tambah Kategori</a>
</div>

<?php if (session()->getFlashdata('success')): ?><div class="alert alert-success"><?= session()->getFlashdata('success') ?></div><?php endif; ?>
<?php if (session()->getFlashdata('error')): ?><div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div><?php endif; ?>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th width="5%">ID</th>
            <th>Nama Kategori</th>
            <th>Deskripsi</th>
            <th width="20%" class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($kategori as $k): ?>
            <tr>
                <td><?= $k['id']; ?></td>
                <td><b><?= $k['nama_kategori']; ?></b></td>
                <td><?= $k['deskripsi'] ?: '-'; ?></td>
                <td class="text-center">
                    <a href="<?= base_url('kategori/edit/' . $k['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="<?= base_url('kategori/delete/' . $k['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus kategori ini?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
