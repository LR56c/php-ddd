<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Src\shared\domain\EmailError;
use Src\shared\domain\ValidEmail;

class ValidEmailTest extends TestCase
{
    public function test_can_create_a_valid_email(): void
    {
        $email = 'test@example.com';
        $validEmail = ValidEmail::from($email);

        $this->assertInstanceOf(ValidEmail::class, $validEmail);
        $this->assertEquals($email, $validEmail->value());
    }

    public function test_cannot_create_an_invalid_email(): void
    {
        $email = 'invalid-email';
        $invalidEmail = ValidEmail::from($email);

        $this->assertEquals(EmailError::InvalidFormat, $invalidEmail);
    }

    public function test_value_method_returns_correct_email(): void
    {
        $email = 'test@example.com';
        $validEmail = ValidEmail::from($email);

        $this->assertEquals($email, $validEmail->value());
    }

    public function test_equals_method_works_correctly(): void
    {
        $email1 = ValidEmail::from('test@example.com');
        $email2 = ValidEmail::from('test@example.com');
        $email3 = ValidEmail::from('another@example.com');

        $this->assertTrue($email1->equals($email2));
        $this->assertFalse($email1->equals($email3));
    }

    public function test_to_string_method_returns_correct_email(): void
    {
        $email = 'test@example.com';
        $validEmail = ValidEmail::from($email);

        $this->assertEquals($email, (string)$validEmail);
    }

    public function test_trims_whitespace_from_email(): void
    {
        $email = '  test@example.com  ';
        $validEmail = ValidEmail::from($email);

        $this->assertEquals('test@example.com', $validEmail->value());
    }
}
