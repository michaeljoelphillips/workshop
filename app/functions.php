<?php

declare(strict_types=1);

namespace App;

use DivisionByZeroError;

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

/**
 * @param float $operandA
 * @param float $operandB
 *
 * @return float
 */
function subtract(float $operandA, float $operandB): float
{
    return $operandA - $operandB;
}

/**
 * @param float $operandA
 * @param float $operandB
 *
 * @return float
 */
function multiply(float $operandA, float $operandB): float
{
    return $operandA * $operandB;
}

/**
 * @param float $operandA
 * @param float $operandB
 *
 * @return float
 */
function divide(float $operandA, float $operandB): float
{
    if (0.0 === $operandB) {
        throw new DivisionByZeroError();
    }

    return $operandA / $operandB;
}
