<div class="card col-md-6 mx-auto">
    <div class="card-header bg-warning text-dark">
        <h5>Edit Kategori</h5>
    </div>
    <div class="card-body">
        <form action="<?= base_url('kategori/update/' . $kategori['id']) ?>" method="POST">
            <div class="mb-3">
                <label>Nama Kategori</label>
                <input type="text" name="nama_kategori" class="form-control" value="<?= $kategori['nama_kategori']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Deskripsi Singkat</label>
                <textarea name="deskripsi" class="form-control" rows="3"><?= $kategori['deskripsi']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-success">Perbarui</button>
            <a href="<?= base_url('kategori') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
