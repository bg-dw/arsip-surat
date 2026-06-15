<?php

namespace App\Controllers;

use App\Models\KategoriModel;

class Kategori extends BaseController
{
    protected $kategoriModel;

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
        helper('log'); // Mengaktifkan log helper
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Kategori Surat',
            'kategori' => $this->kategoriModel->findAll()
        ];
        return view('layout/header', $data) . view('kategori/index', $data) . view('layout/footer');
    }

    public function create()
    {
        $data = ['title' => 'Tambah Kategori Baru'];
        return view('layout/header', $data) . view('kategori/create', $data) . view('layout/footer');
    }

    public function store()
    {
        if (!$this->validate([
            'nama_kategori' => 'required|is_unique[tbl_kategori.nama_kategori]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $nama = $this->request->getVar('nama_kategori');
        $this->kategoriModel->save([
            'nama_kategori' => $nama,
            'deskripsi'     => $this->request->getVar('deskripsi')
        ]);

        catat_log("Menambahkan kategori surat baru: " . $nama);

        return redirect()->to('/kategori')->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Kategori',
            'kategori' => $this->kategoriModel->find($id)
        ];
        return view('layout/header', $data) . view('kategori/edit', $data) . view('layout/footer');
    }

    public function update($id)
    {
        $nama = $this->request->getVar('nama_kategori');
        $this->kategoriModel->update($id, [
            'nama_kategori' => $nama,
            'deskripsi'     => $this->request->getVar('deskripsi')
        ]);

        catat_log("Mengubah data kategori ID [" . $id . "] menjadi: " . $nama);

        return redirect()->to('/kategori')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function delete($id)
    {
        $kategori = $this->kategoriModel->find($id);

        try {
            $this->kategoriModel->delete($id);
            catat_log("Menghapus kategori surat: " . $kategori['nama_kategori']);
            return redirect()->to('/kategori')->with('success', 'Kategori berhasil dihapus.');
        } catch (\Exception $e) {
            // Menangani jika kategori gagal dihapus karena masih terikat dengan data surat (RESTRICT)
            return redirect()->to('/kategori')->with('error', 'Gagal menghapus! Kategori ini masih digunakan oleh beberapa berkas surat.');
        }
    }
}
