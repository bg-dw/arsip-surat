<?php

namespace App\Controllers;

use App\Models\UserModel; // Pastikan model user di-import jika dibutuhkan, atau gunakan query builder

class Log extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_aktivitas_log')
            ->select('tbl_aktivitas_log.*, tbl_users.nama_lengkap')
            ->join('tbl_users', 'tbl_users.id = tbl_aktivitas_log.user_id')
            ->orderBy('waktu', 'DESC');

        // Menggunakan library pagination internal CI4
        $pager = \Config\Services::pager();

        // Batasi hanya 25 log per halaman
        $perPage = 25;
        $page = $this->request->getVar('page') ? (int)$this->request->getVar('page') : 1;
        $offset = ($page - 1) * $perPage;

        // Ambil data dengan LIMIT dan OFFSET
        $logs = $builder->limit($perPage, $offset)->get()->getResultArray();

        // Hitung total data untuk link halaman
        $total = $db->table('tbl_aktivitas_log')->countAllResults();

        $data = [
            'title' => 'Log Aktivitas Sistem',
            'logs'  => $logs,
            'pager' => $pager->makeLinks($page, $perPage, $total, 'default_full')
        ];

        return view('layout/header', $data) . view('log/index', $data) . view('layout/footer');
    }
}
