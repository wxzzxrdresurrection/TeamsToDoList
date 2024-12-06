<?php

namespace Tests\Unit;

use App\Helpers\RandomCharacterGenerator;
use PHPUnit\Framework\TestCase;

class RandomCharacterGeneratorTest extends TestCase
{
    public function testCorrectRandomString(): void
    {
        $length = 10;
        $randomString = RandomCharacterGenerator::generate($length);

        $this->assertEquals($length, strlen($randomString));
        $this->assertIsString($randomString);
        $this->assertMatchesRegularExpression('/^[A-Za-z0-9]{10}$/', $randomString);
    }
}
