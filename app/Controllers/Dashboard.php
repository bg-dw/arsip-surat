<?php

namespace App\Controllers;

use App\Models\SuratModel;
use App\Models\KategoriModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $suratModel = new SuratModel();
        $kategoriModel = new KategoriModel();

        $data = [
            'title' => 'Dashboard',
            'total_surat' => $suratModel->countAllResults(),
            'total_kategori' => $kategoriModel->countAllResults(),
            'surat_terbaru' => $suratModel->getSuratLengkap()
        ];

        return view('layout/header', $data)
            . view('dashboard', $data)
            . view('layout/footer');
    }
}
