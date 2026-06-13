<div class="card">
    <div class="card-header bg-primary text-white">
        <h5>Upload Surat</h5>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('errors')): ?><div class="alert alert-danger">
                <ul><?php foreach (session()->getFlashdata('errors') as $e) : ?><li><?= $e ?></li><?php endforeach ?></ul>
            </div><?php endif; ?>
        <form action="/surat/store" method="POST" enctype="multipart/form-data">
            <div class="mb-3"><label>Nomor Surat</label><input type="text" name="nomor_surat" class="form-control" required></div>
            <div class="mb-3"><label>Judul Surat</label><input type="text" name="judul_surat" class="form-control" required></div>
            <div class="row">
                <div class="col-md-6 mb-3"><label>Tanggal Surat</label><input type="date" name="tanggal_surat" class="form-control" required></div>
                <div class="col-md-6 mb-3"><label>Kategori</label><select name="kategori_id" class="form-select" required>
                        <option value="">-- Pilih --</option><?php foreach ($kategori as $k): ?><option value="<?= $k['id']; ?>"><?= $k['nama_kategori']; ?></option><?php endforeach; ?>
                    </select></div>
            </div>
            <div class="mb-3"><label>File Scan (PDF/JPG/PNG max 5MB)</label><input type="file" name="file_scan" class="form-control" required></div><button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
