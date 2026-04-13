<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\Auth;
use App\Core\Request;

final class AuthController extends Controller
{
    public function showLogin(): void
    {
        $this->view('auth/login', [
            'pageTitle' => 'Connexion',
        ]);
    }

    public function login(): never
    {
        $email = trim((string) Request::input('email', ''));
        $password = (string) Request::input('password', '');

        if (Auth::attempt($email, $password)) {
            $this->redirect('/');
        }

        $this->redirect('/login');
    }

    public function logout(): never
    {
        Auth::logout();
        $this->redirect('/');
    }
}