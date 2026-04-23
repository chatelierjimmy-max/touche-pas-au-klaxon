<?php

declare(strict_types=1);

namespace App\Core;

/**
 * Gère la validation des données de formulaire.
 *
 * Cette classe permet de :
 * - définir des règles de validation (required, email, integer, etc.)
 * - stocker les erreurs associées aux champs
 * - vérifier si la validation échoue
 *
 * Les méthodes sont chaînables pour simplifier l'écriture :
 * (pattern fluent interface)
 */
final class Validator
{
    /**
     * Données à valider.
     *
     * @var array<string, mixed>
     */
    private array $data;

    /**
     * Liste des erreurs de validation.
     *
     * @var array<string, string>
     */
    private array $errors = [];

    /**
     * Initialise le validateur avec les données à vérifier.
     *
     * @param array<string, mixed> $data Données du formulaire.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Vérifie qu'un champ est obligatoire.
     *
     * @param string $field Nom du champ.
     * @param string $message Message d'erreur.
     * @return self
     */
    public function required(string $field, string $message): self
    {
        $value = $this->data[$field] ?? null;

        if ($value === null || trim((string) $value) === '') {
            $this->errors[$field] = $message;
        }

        return $this;
    }

    /**
     * Vérifie qu'un champ est un entier valide.
     *
     * @param string $field Nom du champ.
     * @param string $message Message d'erreur.
     * @return self
     */
    public function integer(string $field, string $message): self
    {
        $value = $this->data[$field] ?? null;

        if ($value === null || filter_var($value, FILTER_VALIDATE_INT) === false) {
            $this->errors[$field] = $message;
        }

        return $this;
    }

    /**
     * Vérifie qu'un entier est supérieur ou égal à une valeur minimale.
     *
     * @param string $field Nom du champ.
     * @param int $min Valeur minimale.
     * @param string $message Message d'erreur.
     * @return self
     */
    public function minInt(string $field, int $min, string $message): self
    {
        $value = $this->data[$field] ?? null;

        if (filter_var($value, FILTER_VALIDATE_INT) === false || (int) $value < $min) {
            $this->errors[$field] = $message;
        }

        return $this;
    }

    /**
     * Vérifie que deux champs sont différents.
     *
     * @param string $fieldA Premier champ.
     * @param string $fieldB Deuxième champ.
     * @param string $message Message d'erreur.
     * @return self
     */
    public function different(string $fieldA, string $fieldB, string $message): self
    {
        $valueA = $this->data[$fieldA] ?? null;
        $valueB = $this->data[$fieldB] ?? null;

        if ((string) $valueA === (string) $valueB) {
            $this->errors[$fieldA] = $message;
        }

        return $this;
    }

    /**
     * Vérifie que la date/heure B est postérieure à la date/heure A.
     *
     * @param string $dateFieldA Champ date A.
     * @param string $timeFieldA Champ heure A.
     * @param string $dateFieldB Champ date B.
     * @param string $timeFieldB Champ heure B.
     * @param string $message Message d'erreur.
     * @return self
     */
    public function afterDateTime(
        string $dateFieldA,
        string $timeFieldA,
        string $dateFieldB,
        string $timeFieldB,
        string $message
    ): self {
        $dateA = $this->data[$dateFieldA] ?? '';
        $timeA = $this->data[$timeFieldA] ?? '';
        $dateB = $this->data[$dateFieldB] ?? '';
        $timeB = $this->data[$timeFieldB] ?? '';

        $datetimeA = strtotime(trim((string) $dateA) . ' ' . trim((string) $timeA));
        $datetimeB = strtotime(trim((string) $dateB) . ' ' . trim((string) $timeB));

        if ($datetimeA === false || $datetimeB === false || $datetimeB <= $datetimeA) {
            $this->errors[$dateFieldB] = $message;
        }

        return $this;
    }

    /**
     * Vérifie qu'un champ est une adresse email valide.
     *
     * @param string $field Nom du champ.
     * @param string $message Message d'erreur.
     * @return self
     */
    public function email(string $field, string $message): self
    {
        $value = $this->data[$field] ?? null;

        if ($value === null || filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
            $this->errors[$field] = $message;
        }

        return $this;
    }

    /**
     * Indique si la validation a échoué.
     *
     * @return bool True si des erreurs existent.
     */
    public function fails(): bool
    {
        return !empty($this->errors);
    }

    /**
     * Retourne toutes les erreurs de validation.
     *
     * @return array<string, string>
     */
    public function errors(): array
    {
        return $this->errors;
    }

    /**
     * Retourne la première erreur détectée.
     *
     * @return string|null Premier message d'erreur ou null.
     */
    public function firstError(): ?string
    {
        return empty($this->errors) ? null : reset($this->errors);
    }
}