<?php

// Time complexity - O(n^2)
// Space complexity - O(1)

$numbers = [2, 10, 9, 8, 3, 7, 1, 5, 4, 6];

// Sorts in ascending order
function myBubbleSort(array $array)
{
    $length = count($array);
    for ($i = 0; $i < $length; $i++) {
        // we do (subtraction $i) because after each top iteration we are sure that 1 new element is bubbled up,
        // and it is on the right position
        for ($j = 0; $j < $length - 1 - $i; $j++) {
            if ($array[$j] > $array[$j + 1]) {
                $temp = $array[$j];
                $array[$j] = $array[$j + 1];
                $array[$j + 1] = $temp;
            }
        }
    }

    return $array;
}

print_r(myBubbleSort($numbers)); // [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]