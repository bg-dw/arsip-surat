<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratModel extends Model
{
    protected $table = 'tbl_surat';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nomor_surat', 'judul_surat', 'tanggal_surat', 'file_path', 'kategori_id', 'user_id', 'nama_user', 'keterangan'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /**
     * Mengambil data surat dengan filter tahun dan pagination
     */


    public function getSuratLengkap()
    {
        return $this->select('tbl_surat.*, tbl_kategori.nama_kategori')
            ->join('tbl_kategori', 'tbl_kategori.id = tbl_surat.kategori_id')
            ->orderBy('tbl_surat.tanggal_surat', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function getSuratFiltered($tahun = null, $perPage = 10, $offset = 0)
    {
        $builder = $this->select('tbl_surat.*, tbl_kategori.nama_kategori')
            ->join('tbl_kategori', 'tbl_kategori.id = tbl_surat.kategori_id');

        // Jika filter tahun dipilih
        if (!empty($tahun)) {
            $builder->where("YEAR(tbl_surat.tanggal_surat)", $tahun);
        }

        return $builder->orderBy('tbl_surat.tanggal_surat', 'DESC')
            ->limit($perPage, $offset)
            ->get()
            ->getResultArray();
    }

    /**
     * Menghitung total surat berdasarkan filter tahun (untuk pagination)
     */
    public function countSuratFiltered($tahun = null)
    {
        if (!empty($tahun)) {
            return $this->where("YEAR(tanggal_surat)", $tahun)->countAllResults();
        }
        return $this->countAllResults();
    }

    /**
     * Mengambil daftar tahun yang unik dari data surat yang ada di DB
     * Digunakan untuk memunculkan pilihan pada dropdown filter
     */
    public function getDaftarTahun()
    {
        return $this->select("DISTINCT(YEAR(tanggal_surat)) as tahun")
            ->orderBy("tahun", "DESC")
            ->get()
            ->getResultArray();
    }
}
