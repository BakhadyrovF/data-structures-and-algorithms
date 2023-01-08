<?php


/**
 * Time complexity - O(2^n)
 * Space complexity - O(n)
 */
function fibonacciRecursive(int $n): int
{
    if ($n < 2) {
        return $n;
    }

    return fibonacciRecursive($n - 1) + fibonacciRecursive($n - 2);
}

/**
 * Time complexity - O(n)
 * Space complexity - O(1)
 */
function fibonacciIterative(int $n): int
{
    if ($n === 0) {
        return $n;
    }

    $prev = 0;
    $current = 1;

    for ($i = 0; $i < $n - 1; $i++) {
        $tmp = $prev + $current;
        $prev = $current;
        $current = $tmp;
    }

    return $current;
}

echo fibonacciIterative(50);
//echo fibonacciRecursive(50);