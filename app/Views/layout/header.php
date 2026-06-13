<!DOCTYPE html>
<html lang="id">

<head>
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('dashboard') ?>">E-Arsip Surat</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('surat') ?>">Data Surat</a></li>
                </ul><span class="navbar-text text-white me-3">Halo, <?= session()->get('nama_lengkap'); ?></span><a href="<?= base_url('logout') ?>" class="btn btn-danger btn-sm">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container">
