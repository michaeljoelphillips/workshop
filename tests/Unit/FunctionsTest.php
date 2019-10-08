<?php

declare(strict_types=1);

namespace Tests\Unit;

use function App\add;
use function App\divide;
use function App\multiply;
use function App\subtract;
use DivisionByZeroError;
use PHPUnit\Framework\TestCase;

class FunctionsTest extends TestCase
{
    public function testAdd(): void
    {
        self::assertEquals(4, add(2, 2));
        self::assertEquals(8, add(5, 3));
        self::assertEquals(42, add(15, 27));
    }

    public function testSubtract(): void
    {
        self::assertEquals(2, subtract(4, 2));
        self::assertEquals(13, subtract(2, -11));
        self::assertEquals(1.5, subtract(3.0, 1.5));
    }

    public function testMultiply(): void
    {
        self::assertEquals(8, multiply(4, 2));
        self::assertEquals(1000, multiply(100, 10));
        self::assertEquals(4.5, multiply(3.0, 1.5));
    }

    public function testDivide(): void
    {
        self::assertEquals(2, divide(4, 2));
        self::assertEquals(10, divide(100, 10));
        self::assertEquals(2.0, divide(3.0, 1.5));
    }

    public function testDivideWithZero(): void
    {
        self::expectException(DivisionByZeroError::class);

        divide(4, 0);
    }
}
