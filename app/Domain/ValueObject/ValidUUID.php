<?php

namespace App\Domain\ValueObject;

use Illuminate\Support\Str;

class ValidUUID
{
    private string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function create(): self
    {
        return new self((string) Str::uuid());
    }

    public static function from(string $value): self|UUIDError
    {
        if (!Str::isUuid($value)) {
            return UUIDError::InvalidFormat;
        }

        return new self($value);
    }

    public function value(): string
    {
        return $this->value;
    }
}