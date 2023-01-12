<?php


$numbers = [2, 5, 4, 3, 2, 6, 3, 5, 1, 4, 2, 6];

/**
 * Time complexity - O(n^2)
 * Space complexity - O(1)
 */
function myInsertionSort(array $array)
{
    for ($i = 1; $i < count($array); $i++) {
        if ($array[$i] < $array[0]) {
            // swap
            array_unshift($array, array_splice($array, $i, 1)[0]);
        } else {
            for ($j = $i - 1; $j > 0; $j--) {
                if ($array[$i] < $array[$j] && $array[$i] >= $array[$j - 1]) {
                    // simple adding element at specific index and shift rest of the elements with built-in function
                    array_splice($array, $j, 0, array_splice($array, $i, 1)[0]);
                }
            }
        }
    }

    return $array;
}


print_r(myInsertionSort($numbers));





