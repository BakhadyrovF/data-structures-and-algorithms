<?php

$numbers = range(50, 1);


// Time complexity - O(n^2)
// Space complexity - O(1)
function myInsertionSort(array $array)
{
    for ($i = 1; $i < count($array); $i++) {
        if ($array[$i] < $array[0]) {
            // swap
            array_unshift($array, array_splice($array, $i, 1)[0]);
        } else {
            for ($j = 1; $j < $i; $j++) {
                if ($array[$i] < $array[$j]) {
                    // simple adding element at specific index and shift rest of the elements with built-in function
                    array_splice($array, $j, 0, array_splice($array, $i, 1)[0]);
                }
            }
        }
    }

    return $array;
}


print_r(myInsertionSort($numbers));


// Usage of O(n) space complexity, makes algorithm faster and simpler without (shifts, splices)
// Time complexity - O(n^2)
// Space complexity - O(n)
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

//print_r(mySimpleInsertionSort($numbers)); // [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]

