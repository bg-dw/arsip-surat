<?php

if (!function_exists('catat_log')) {
    function catat_log($aktivitas)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_aktivitas_log');

        $data = [
            'user_id'   => session()->get('user_id') ?? 1, // Jika belum login (saat seeder), default ke ID 1
            'aktivitas' => $aktivitas,
            'waktu'     => date('Y-m-d H:i:s')
        ];

        $builder->insert($data);
    }
}
