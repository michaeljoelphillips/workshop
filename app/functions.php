<?php

declare(strict_types=1);

namespace App;

function printFullName(string $firstName, string $lastName): string
{
    return sprintf('%s %s', $firstName, $lastName);
}

/**
 * @param float $operandA
 * @param float $operandB
 *
 * @return float
 */
function add(float $operandA, float $operandB): float
{
    return $operandA + $operandB;
}
