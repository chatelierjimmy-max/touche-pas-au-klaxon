<?php

declare(strict_types=1);

namespace App\Core;

use PDO;
use PDOException;
use RuntimeException;

final class Database
{
    private static ?PDO $instance = null;

    /**
    * Initialise la connexion PDO.
    *
    * @param array{
    *     host: string,
    *     port: int,
    *     database: string,
    *     username: string,
    *     password: string,
    *     charset: string
    * } $config
    * @return void
    */
    
    public static function init(array $config): void
    {
        if (self::$instance !== null) {
            return;
        }

        $dsn = sprintf(
            'mysql:host=%s;port=%d;dbname=%s;charset=%s',
            $config['host'],
            $config['port'],
            $config['database'],
            $config['charset']
        );

        try {
            self::$instance = new PDO(
                $dsn,
                $config['username'],
                $config['password'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        } catch (PDOException $exception) {
            throw new RuntimeException(
                'Connexion à la base de données impossible : ' . $exception->getMessage(),
                0,
                $exception
            );
        }
    }

    public static function connection(): PDO
    {
        if (self::$instance === null) {
            throw new RuntimeException('La base de données n’a pas été initialisée.');
        }

        return self::$instance;
    }

    /**
     * Réinitialise l'instance PDO.
     *
     * Utile pour les tests automatisés.
     *
     * @return void
     */
    public static function reset(): void
    {
        self::$instance = null;
    }
}