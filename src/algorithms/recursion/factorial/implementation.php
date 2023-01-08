<?php

$number = 5;
function findFactorialRecursive(int $number): int
{
    if ($number === 1) {
        return 1;
    }

    return $number * findFactorialRecursive($number - 1);
}

function findFactorialIterative(int $number): int
{
    $factorial = $number;
    for ($i = $number - 1; $i >= 1; $i--) {
        $factorial *= $i;
    }

    return $factorial;
}

echo findFactorialIterative($number);
echo findFactorialRecursive($number);