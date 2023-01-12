<?php

$numbers = [2, 5, 4, 3, 2, 6, 3, 5, 1, 4, 2, 6];

/**
 * Usage of O(n) space complexity, makes algorithm faster and simpler without (shifts, splices)
 * Time complexity - O(n^2)
 * Space complexity - O(n)
*/
function mySimpleInsertionSort(array $array)
{
    $sortedArray = [];

    for ($i = 0; $i < count($array); $i++) {
        // push element to the sorted array
        $sortedArray[] = $array[$i];

        // iterate through each element of sorted array, starting from the largest
        for ($j = $i; $j > 0; $j--) {
            // check if the largest value is greater than current, then swap them and continue iterating
            if ($sortedArray[$j] < $sortedArray[$j - 1]) {
                // swapping
                $tmp = $sortedArray[$j - 1];
                $sortedArray[$j - 1] = $sortedArray[$j];
                $sortedArray[$j] = $tmp;
            } else {
                // we can break the loop, because if largest element is smaller than current
                // rest of elements are also smaller, so we can just leave current element in the end.
                break;
            }
        }
    }

    return $sortedArray;
}