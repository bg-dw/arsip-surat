<div class="row">
    <div class="col-md-6">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Surat Diarsipkan</h5>
                <h1><?= $total_surat; ?> Berkas</h1>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Kategori Surat</h5>
                <h1><?= $total_kategori; ?> Kategori</h1>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header bg-secondary text-white">Surat Masuk Terbaru</div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No Surat</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Tgl Upload</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($surat_terbaru as $s): ?>
                    <tr>
                        <td><?= $s['nomor_surat']; ?></td>
                        <td><?= $s['judul_surat']; ?></td>
                        <td><span class="badge bg-info text-dark"><?= $s['nama_kategori']; ?></span></td>
                        <td><?= date('d-m-Y H:i', strtotime($s['tanggal_upload'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
