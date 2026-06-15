<?php

namespace App\Controllers;

use App\Models\SuratModel;
use App\Models\KategoriModel;

class Surat extends BaseController
{
    protected $suratModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->suratModel = new SuratModel();
        $this->kategoriModel = new KategoriModel();
        helper('log'); // Mengaktifkan log helper
    }

    public function index()
    {
        // Tangkap filter tahun dari URL query string (?tahun=2026)
        $tahunDipilih = $this->request->getVar('tahun');

        // PERUBAHAN: Jika kosong (baru buka halaman), set otomatis ke tahun berjalan saat ini (cth: 2026)
        if (empty($tahunDipilih)) {
            $tahunDipilih = date('Y');
        }

        // Pengaturan Pagination
        $pager = \Config\Services::pager();
        $perPage = 10; // Menampilkan 10 surat per halaman
        $page = $this->request->getVar('page') ? (int)$this->request->getVar('page') : 1;
        $offset = ($page - 1) * $perPage;

        // Ambil data dari Model berdasarkan tahun yang sudah ditentukan default-nya
        $dataSurat = $this->suratModel->getSuratFiltered($tahunDipilih, $perPage, $offset);
        $totalSurat = $this->suratModel->countSuratFiltered($tahunDipilih);

        // Ambil daftar tahun yang ada di DB untuk isi dropdown
        $daftarTahun = $this->suratModel->getDaftarTahun();

        // LOGIKA TAMBAHAN: Jika di database belum ada data surat sama sekali di tahun berjalan,
        // pastikan tahun berjalan saat ini tetap muncul di pilihan dropdown agar tidak kosong melompong.
        $tahunSekarang = date('Y');
        $tahunSudahAda = array_column($daftarTahun, 'tahun');
        if (!in_array($tahunSekarang, $tahunSudahAda)) {
            // Tambahkan tahun sekarang ke baris paling atas array dropdown
            array_unshift($daftarTahun, ['tahun' => $tahunSekarang]);
        }

        $data = [
            'title'         => 'Data Arsip Surat',
            'surat'         => $dataSurat,
            'daftar_tahun'  => $daftarTahun,
            'tahun_aktif'   => $tahunDipilih,
            'pager'         => $pager->makeLinks($page, $perPage, $totalSurat, 'default_full')
        ];

        return view('layout/header', $data)
            . view('surat/index', $data)
            . view('layout/footer');
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Surat Baru',
            'kategori' => $this->kategoriModel->findAll()
        ];
        return view('layout/header', $data) . view('surat/create', $data) . view('layout/footer');
    }

    public function store()
    {
        // Validasi input form & file scan
        if (!$this->validate([
            'nomor_surat' => 'required|is_unique[tbl_surat.nomor_surat]',
            'judul_surat' => 'required',
            'tanggal_surat' => 'required',
            'kategori_id' => 'required',
            'file_scan' => 'uploaded[file_scan]|max_size[file_scan,5120]|ext_in[file_scan,pdf,jpg,jpeg,png]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $fileScan = $this->request->getFile('file_scan');

        // Memindahkan file ke folder /public/uploads/
        if ($fileScan->isValid() && !$fileScan->hasMoved()) {
            $newName = $fileScan->getRandomName();
            $fileScan->move(ROOTPATH . 'public/uploads', $newName);
            $filePath = 'uploads/' . $newName;
        }

        $this->suratModel->save([
            'nomor_surat'   => $this->request->getVar('nomor_surat'),
            'judul_surat'   => $this->request->getVar('judul_surat'),
            'tanggal_surat' => $this->request->getVar('tanggal_surat'),
            'kategori_id'   => $this->request->getVar('kategori_id'),
            'user_id'       => session()->get('user_id'),
            'file_path'     => $filePath,
            'keterangan'    => $this->request->getVar('keterangan'),
        ]);
        catat_log("Mengarsipkan surat baru dengan nomor: " . $this->request->getVar('nomor_surat'));
        return redirect()->to('/surat')->with('success', 'Surat berhasil diarsipkan.');
    }

    public function delete($id)
    {
        $surat = $this->suratModel->find($id);

        // Hapus berkas fisik file dari server jika ada
        if ($surat && file_exists(ROOTPATH . 'public/' . $surat['file_path'])) {
            unlink(ROOTPATH . 'public/' . $surat['file_path']);
        }
        catat_log("Menghapus arsip surat resmi dengan Nomor: " . $surat['nomor_surat']);
        $this->suratModel->delete($id);
        return redirect()->to('/surat')->with('success', 'Surat berhasil dihapus.');
    }

    public function download($id)
    {
        $surat = $this->suratModel->find($id);
        $fileActualPath = ROOTPATH . 'public/' . $surat['file_path'];

        if ($surat && file_exists($fileActualPath)) {
            // 1. Ambil ekstensi asli dari file (misal: pdf, jpg, png)
            $extension = pathinfo($fileActualPath, PATHINFO_EXTENSION);

            // 2. Bersihkan nomor dan judul surat dari karakter yang dilarang oleh OS (\ / : * ? " < > |)
            // Karakter ilegal akan otomatis diganti dengan underscore (_)
            $cleanNomor = preg_replace('/[^a-zA-Z0-9_.-]/', '_', $surat['nomor_surat']);
            $cleanJudul = preg_replace('/[^a-zA-Z0-9_.-]/', '_', $surat['judul_surat']);

            // 3. Gabungkan menjadi nama baru: nomor_surat-judul_surat.ekstensi
            $customName = $cleanNomor . '-' . $cleanJudul . '.' . $extension;

            // 4. Download file dengan nama samaran baru
            return $this->response->download($fileActualPath, null)->setFileName($customName);
        }

        return redirect()->back()->with('error', 'File tidak ditemukan di server.');
    }
}
