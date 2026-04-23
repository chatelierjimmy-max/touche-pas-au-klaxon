<?php

declare(strict_types=1);

namespace App\Core;

use App\Repository\UserRepository;

/**
 * Gère l'authentification des utilisateurs.
 *
 * Cette classe fournit des méthodes statiques pour :
 * - authentifier un utilisateur (login)
 * - récupérer l'utilisateur connecté
 * - vérifier l'état de connexion
 * - vérifier le rôle administrateur
 * - gérer la déconnexion
 *
 * Les données utilisateur sont stockées en session.
 */
final class Auth
{
    /**
     * Tente d'authentifier un utilisateur avec ses identifiants.
     *
     * Processus :
     * - recherche de l'utilisateur par email
     * - vérification du mot de passe (password_verify)
     * - stockage des informations essentielles en session
     *
     * @param string $email Adresse email de l'utilisateur.
     * @param string $password Mot de passe saisi.
     * @return bool True si l'authentification réussit, sinon false.
     */
    public static function attempt(string $email, string $password): bool
    {
        $repository = new UserRepository();
        $user = $repository->findByEmail($email);

        // Utilisateur introuvable
        if ($user === null) {
            return false;
        }

        // Mot de passe incorrect
        if (!password_verify($password, $user['password'])) {
            return false;
        }

        // Stockage des informations utilisateur en session
        Session::put('user', [
            'id' => $user['id'],
            'last_name' => $user['last_name'],
            'first_name' => $user['first_name'],
            'email' => $user['email'],
            'role' => $user['role'],
        ]);

        return true;
    }

    /**
     * Retourne l'utilisateur actuellement connecté.
     *
     * @return array<string, mixed>|null Données utilisateur ou null si non connecté.
     */
    public static function user(): ?array
    {
        return Session::get('user');
    }

    /**
     * Vérifie si un utilisateur est connecté.
     *
     * @return bool True si un utilisateur est présent en session.
     */
    public static function check(): bool
    {
        return self::user() !== null;
    }

    /**
     * Vérifie si l'utilisateur connecté possède le rôle ADMIN.
     *
     * @return bool True si l'utilisateur est administrateur.
     */
    public static function isAdmin(): bool
    {
        $user = self::user();

        return $user !== null && $user['role'] === 'ADMIN';
    }

    /**
     * Déconnecte l'utilisateur courant.
     *
     * Supprime les données utilisateur de la session.
     *
     * @return void
     */
    public static function logout(): void
    {
        Session::forget('user');
    }
}