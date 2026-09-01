<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class SsoAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Ambil path URI yang sedang diakses

        $uri = $request->getUri()->getPath();

        // Jika user sedang mengakses route ssoCallback, jangan di-redirect!
        if (strpos($uri, 'auth/ssoCallback') !== false) {
            return;
        }

        // Jika belum ada session lokal, lempar ke SSO Login
        if (!session()->get('is_logged_in')) {
            return redirect()->to('http://localhost:9600/sso/public/');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
