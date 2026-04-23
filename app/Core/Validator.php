<?php

declare(strict_types=1);

namespace App\Core;

final class Validator
{
    private array $data;
    private array $errors = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function required(string $field, string $message): self
    {
        $value = $this->data[$field] ?? null;

        if ($value === null || trim((string) $value) === '') {
            $this->errors[$field] = $message;
        }

        return $this;
    }

    public function integer(string $field, string $message): self
    {
        $value = $this->data[$field] ?? null;

        if ($value === null || filter_var($value, FILTER_VALIDATE_INT) === false) {
            $this->errors[$field] = $message;
        }

        return $this;
    }

    public function minInt(string $field, int $min, string $message): self
    {
        $value = $this->data[$field] ?? null;

        if (filter_var($value, FILTER_VALIDATE_INT) === false || (int) $value < $min) {
            $this->errors[$field] = $message;
        }

        return $this;
    }

    public function different(string $fieldA, string $fieldB, string $message): self
    {
        $valueA = $this->data[$fieldA] ?? null;
        $valueB = $this->data[$fieldB] ?? null;

        if ((string) $valueA === (string) $valueB) {
            $this->errors[$fieldA] = $message;
        }

        return $this;
    }

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

    public function email(string $field, string $message): self
    {
        $value = $this->data[$field] ?? null;

        if ($value === null || filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
            $this->errors[$field] = $message;
        }

        return $this;
    }

    public function fails(): bool
    {
        return !empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function firstError(): ?string
    {
        return empty($this->errors) ? null : reset($this->errors);
    }
}