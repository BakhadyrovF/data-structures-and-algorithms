<?php

$input = 'Hi My name is Andrei'; // 'ierdnA si eman yM Ih'

/**
 * Create a function that reverses a string:
 * 'Hi My name is Andrei' should be:
 * 'ierdnA si eman yM Ih'
 */


/**
 * Solution without built-in methods - O(n)
 *
 * Steps:
 * 1. Initialize a new variable with empty string
 * 2. Iterate over each letter of string starting from the end and concat it to new variable
 * 3. Return result
 *
 *
 * Time complexity is O(n)
 * Space complexity is O(n)
 */
function reverse(string $string)
{
    $reversed = '';
    for ($i = strlen($string) - 1; $i >= 0; $i--) {
        $reversed .= $string[$i]; // also substr()/mb_substr() can be useful here
    }

    return $reversed;
}



/**
 * Solution with built-in methods - O(n)
 */
function reverseWithBuiltInMethod(string $string)
{
    return strrev($string);
}



/**
 * Naive Solution - O(n^2)
 *
 * Steps:
 * 1. Take every word of string and add it to array (from string to array of words separated by space ' ')
 * 2. Iterate over every word of array starting from the end and initialize variable with empty string
 * 3. Iterate over every letter of particular word starting from the end and concat it to new variable
 * 4. Add reversed word to the empty array in particular index
 * 5. Convert every element of array to string separated by space ' '
 * 6. return result
 *
 * Time complexity is O(n^2)
 * Space complexity is O(n) or O(n^2) because we initialized new variable for each element of array
 */
function reverseNaiveSolution(string $string)
{
    $words = explode(' ', $string);
    $reversed = [];

    for ($i = count($words) - 1; $i >= 0; $i--) {
        $reversedWord = '';

        for ($j = strlen($words[$i]) - 1; $j >= 0; $j--) {
            $reversedWord .= $words[$i][$j]; // also substr()/mb_substr() can be useful here
        }

        $reversed[$i] = $reversedWord; // or we can do strrev($words[$i])
    }

    return implode(' ', $reversed);
}



