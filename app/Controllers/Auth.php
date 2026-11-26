<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Auth extends BaseController
{
    private $ssoServer;
    private $clientId;
    private $clientSecret;
    private $redirectUri;

    public function __construct()
    {
        helper('log'); // Mengaktifkan log helper
        // Konfigurasi SSO dibaca dari .env saja - secret TIDAK BOLEH ditulis di kode.
        $this->ssoServer = env('SSO_SERVER_URL', 'http://localhost:9600/sso/public/');
        $this->clientId = env('SSO_CLIENT_ID', '4');
        $this->clientSecret = env('SSO_CLIENT_SECRET');
    }

    private function getRedirectUri()
    {
        if ($this->redirectUri === null) {
            $this->redirectUri = base_url('auth/ssoCallback');
        }

        return $this->redirectUri;
    }

    /**
     * Secret client wajib ada di .env - tanpa itu login SSO gagal
     * dengan pesan jelas, bukan diam-diam memakai nilai lain.
     */
    private function cekClientSecret()
    {
        if (empty($this->clientSecret)) {
            die('SSO_CLIENT_SECRET belum diatur di .env - login SSO tidak bisa jalan tanpa secret client.');
        }
    }

    /**
     * 1. Halaman/Method awal yang memicu login SSO
     */
    public function login()
    {
        $this->cekClientSecret();
        $queryParams = http_build_query([
            'client_id' => $this->clientId,
            'redirect_uri' => $this->getRedirectUri(),
            'response_type' => 'code',
            'scope' => '',
        ]);
        dd($queryParams);

        return redirect()->to($this->ssoServer . 'oauth/authorize?' . $queryParams);
    }

    /**
     * 2. Callback penerima Authorization Code dari Laravel SSO
     */
    public function ssoCallback()
    {
        $this->cekClientSecret();
        $code = $this->request->getGet('code');
        if (!$code) {
            return $this->login();
        }
        $client = \Config\Services::curlrequest();

        try {
            // Step A: Tukar Authorization Code dengan Access Token
            $response = $client->post($this->ssoServer . 'oauth/token', [
                'form_params' => [
                    'grant_type' => 'authorization_code',
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'redirect_uri' => $this->getRedirectUri(),
                    'code' => $code,
                ],
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'http_errors' => false,
            ]);

            $tokenData = json_decode($response->getBody(), true);

            if (isset($tokenData['error'])) {
                return die('Gagal mendapatkan token: ' . ($tokenData['message'] ?? $tokenData['error']));
            }

            $accessToken = $tokenData['access_token'];

            // Step B: Ambil data User dari Server SSO menggunakan Access Token
            $userResponse = $client->get($this->ssoServer . 'api/user', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Accept' => 'application/json',
                ],
                'http_errors' => false,
            ]);

            $userData = json_decode($userResponse->getBody(), true);
            // Step C: Set Session Lokal CodeIgniter 4
            session()->set([
                'is_logged_in' => true,
                'user_id' => $userData['sso_user_id'] ?? null,
                'name' => $userData['name'] ?? null,
                'user_name' => $userData['username'] ?? null,
                'user_email' => $userData['email'] ?? null,
                'user_type' => $userData['type'] ?? null,
                'role' => $userData['role'] ?? null,
                'sso_token' => $accessToken,
            ]);

            catat_log(($userData['name'] ?? null) . " Berhasil Login!");
            // Step D: Redirect ke Dashboard Utama
            return redirect()->to(base_url('/dashboard'));
        } catch (\Exception $e) {
            return die('Terjadi kesalahan SSO: ' . $e->getMessage());
        }
    }

    /**
     * 3. Method Logout
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to($this->ssoServer . "dashboard");
    }
}
