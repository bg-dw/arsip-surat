<!DOCTYPE html>
<html lang="id">

<head>
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('dashboard') ?>">E-Arsip Surat</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('surat') ?>">Data Surat</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('kategori') ?>">Kategori Surat</a></li>
                    <?php if (session()->get('role') === 'admin'): ?>
                        <li class="nav-item"><a class="nav-link text-warning" href="<?= base_url('users') ?>">Manajemen User</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('log') ?>">Log Aktivitas</a></li>
                </ul>
                <div class="navbar-nav ms-auto pt-2 pt-lg-0">
                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle border-secondary" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            👤 <?= session()->get('nama_lengkap'); ?> (<?= ucfirst(session()->get('role')); ?>)
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownMenuButton">
                            <li>
                                <a class="dropdown-item py-2" href="<?= base_url('profil') ?>">
                                    ⚙️ Pengaturan Profil
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item text-danger py-2" href="<?= base_url('logout') ?>" onclick="return confirm('Apakah Anda ingin keluar?')">
                                    🚪 Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
