<?php

$inputOne = [0, 3];
$inputTwo = [4];

/**
 * Create a function that merges sorted arrays:
 * [0, 3, 4, 31], [4, 6, 30] should be:
 * [0, 3, 4, 4, 6, 30, 31]
 */


/**
 * Solution - O(a + b)
 *
 * Steps:
 * 1. Initialize empty array and increments for each array
 * 2. Take first items of each array and assign to variables
 * 3. Iterate until firstItem or SecondItem exists (is not null)
 * 4. Check if secondItem is not exists or firstItem is not null and less than secondItem then add firstItem to result array
 *    and increment firstItem's increment, assign next value from firstArray to firstItem if exists,
 *    otherwise assign null
 * 5. Else (secondItem is exists and less than firstItem) add secondItem to result array
 *    and increment secondItem's increment, so that we can assign next value from secondArray to secondItem if exists,
 *    otherwise assign null
 * 
 * Time complexity is O(n)
 * Space complexity is O(n)
 */
function mergeSortedArrays(array $firstArray, array $secondArray)
{
    $mergedArrays = [];
    $i = 0;
    $j = 0;
    $firstItem = $firstArray[0];
    $secondItem = $secondArray[0];

    while ($firstItem || $secondItem) {
        if (!$secondItem || (!is_null($firstItem) && $firstItem < $secondItem)) {
            $mergedArrays[] = $firstItem;
            $firstItem = $firstArray[++$i] ?? null;
        } else {
            $mergedArrays[] = $secondItem;
            $secondItem = $secondArray[++$j] ?? null;
        }
    }

    return $mergedArrays;
}

print_r(mergeSortedArrays($inputOne, $inputTwo));