<?php

namespace App\Domain\ValueObject;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;
use Stringable;

enum UUIDError
{
    case InvalidFormat;
}

final readonly class ValidUUID implements Stringable
{
    private string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function from(string $id): self|UUIDError
    {
        return Uuid::isValid($id)
            ? new self($id)
            : UUIDError::InvalidFormat;
    }

    public static function create(): self
    {
        return new self(Uuid::uuid4()->toString());
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(ValidUUID $other): bool
    {
        return $this->value === $other->value();
    }

    public function __toString(): string
    {
        return $this->value();
    }
}
