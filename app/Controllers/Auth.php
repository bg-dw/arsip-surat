<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        if (session()->get('logged_in')) return redirect()->to('/dashboard');
        return view('auth/login');
    }
    public function loginAuth()
    {
        $model = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $data = $model->where('username', $username)->first();
        if ($data) {
            if (password_verify($password, $data['password'])) { //password_verify bawaan php
                session()->set([
                    'user_id' => $data['id'],
                    'username' => $data['username'],
                    'nama_lengkap' => $data['nama_lengkap'],
                    'role' => $data['role'],
                    'logged_in' => TRUE
                ]);
                return redirect()->to('/dashboard');
            }
        }
        return redirect()->to('/login')->with('error', 'Username atau Password Salah.');
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
