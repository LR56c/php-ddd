<?php


namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Src\shared\domain\UUIDError;
use Src\shared\domain\ValidUUID;

class ValidUUIDTest extends TestCase
{
    public function test_it_creates_a_valid_uuid()
    {
        $uuid = ValidUUID::create();

        $this->assertInstanceOf(ValidUUID::class, $uuid);


        $this->assertIsString($uuid->value());
        $this->assertMatchesRegularExpression(
            '/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i',
            $uuid->value()
        );
    }

    public function test_it_detects_invalid_format()
    {
        $result = ValidUUID::from('invalid-uuid-string');
        $this->assertEquals(UUIDError::InvalidFormat, $result);
    }
}
