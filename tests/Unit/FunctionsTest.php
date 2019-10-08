<?php

declare(strict_types=1);

namespace Tests\Unit;

use function App\add;
use PHPUnit\Framework\TestCase;

class FunctionsTest extends TestCase
{
    public function testAdd(): void
    {
        self::assertEquals(4, add(2, 2));
    }
}
