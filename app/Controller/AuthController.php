<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\Auth;
use App\Core\Request;
use App\Core\Flash;
use App\Core\Validator;

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
    $data = [
        'email' => Request::input('email'),
        'password' => Request::input('password'),
    ];

    $validator = new Validator($data);

    $validator
        ->required('email', 'L’adresse email est obligatoire.')
        ->email('email', 'L’adresse email est invalide.')
        ->required('password', 'Le mot de passe est obligatoire.');

    if ($validator->fails()) {
        Flash::set('error', (string) $validator->firstError());
        $this->redirect('/login');
    }

    $email = trim((string) $data['email']);
    $password = (string) $data['password'];

    if (Auth::attempt($email, $password)) {
        $this->redirect('/');
    }

    Flash::set('error', 'Identifiants invalides.');
    $this->redirect('/login');
}

    public function logout(): never
    {
        Auth::logout();
        $this->redirect('/');
    }
}