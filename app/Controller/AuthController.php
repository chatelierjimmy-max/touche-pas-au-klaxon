<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\Auth;
use App\Core\Request;
use App\Core\Flash;
use App\Core\Validator;

/**
 * Gère l'authentification des utilisateurs.
 *
 * Cette classe permet :
 * - d'afficher le formulaire de connexion
 * - de traiter la connexion
 * - de déconnecter l'utilisateur
 */
final class AuthController extends Controller
{
    /**
     * Affiche le formulaire de connexion.
     *
     * @return void
     */
    public function showLogin(): void
    {
        $this->view('auth/login', [
            'pageTitle' => 'Connexion',
        ]);
    }

    /**
     * Traite la tentative de connexion utilisateur.
     *
     * La méthode :
     * - récupère les données du formulaire
     * - valide les champs (email + mot de passe)
     * - tente l'authentification
     * - redirige selon le résultat
     *
     * @return never
     */
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

    /**
     * Déconnecte l'utilisateur actuellement connecté.
     *
     * Supprime la session et redirige vers la page d'accueil.
     *
     * @return never
     */
    public function logout(): never
    {
        Auth::logout();
        $this->redirect('/');
    }
}