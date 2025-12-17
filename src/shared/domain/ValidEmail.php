<?php

namespace Src\shared\domain;

use Respect\Validation\Validator as v;
use Stringable;

final readonly class ValidEmail implements Stringable
{
    private string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function from(string $email): self|EmailError
    {
        $trimmedEmail = trim($email);
        return v::email()->validate($trimmedEmail)
            ? new self($trimmedEmail)
            : EmailError::InvalidFormat;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(ValidEmail $other): bool
    {
        return $this->value === $other->value();
    }


    public function __toString(): string
    {
        return $this->value();
    }
}
