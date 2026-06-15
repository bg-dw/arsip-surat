<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Daftar Arsip Scan Surat</h3>
    <a href="<?= base_url('surat/create') ?>" class="btn btn-primary">+ Unggah Surat Baru</a>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<div class="card mb-3 bg-light">
    <div class="card-body">
        <form action="<?= base_url('surat') ?>" method="GET" class="row g-2 align-items-center">
            <div class="col-auto">
                <label class="col-form-label"><b>Filter Arsip Tahun:</b></label>
            </div>
            <div class="col-auto">
                <select name="tahun" class="form-select form-select-sm" onchange="this.form.submit()">
                    <?php foreach ($daftar_tahun as $dt): ?>
                        <option value="<?= $dt['tahun']; ?>" <?= $tahun_aktif == $dt['tahun'] ? 'selected' : ''; ?>>
                            <?= $dt['tahun']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-auto">
                <noscript>
                    <button type="submit" class="btn btn-sm btn-secondary">Terapkan</button>
                </noscript>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-bordered table-hover mb-0">
            <thead class="table-dark text-center">
                <tr>
                    <th width="25%">No Surat</th>
                    <th>Judul/Perihal</th>
                    <th>Kategori</th>
                    <th>Tanggal Surat</th>
                    <th>Pengunggah</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($surat)): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Tidak ada berkas surat yang ditemukan untuk tahun ini.</td>
                    </tr>
                <?php endif; ?>
                <?php foreach ($surat as $s): ?>
                    <tr>
                        <td><b><?= $s['nomor_surat']; ?></b></td>
                        <td><?= $s['judul_surat']; ?></td>
                        <td class="text-center"><span class="badge bg-secondary"><?= $s['nama_kategori']; ?></span></td>
                        <td class="text-center"><?= date('d/m/Y', strtotime($s['tanggal_surat'])); ?></td>
                        <td><?= $s['nama_lengkap']; ?></td>
                        <td class="text-center">
                            <a href="<?= base_url('surat/download/' . $s['id']) ?>" class="btn btn-sm btn-success">Download</a>
                            <a href="<?= base_url('surat/delete/' . $s['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center mt-3">
    <?= $pager ?>
</div>
