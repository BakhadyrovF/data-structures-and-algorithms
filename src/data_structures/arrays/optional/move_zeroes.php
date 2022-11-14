<?php

$nums = [0, 1, 0, 3, 0, 12];



/**
 * Move Zeroes
 * @link https://leetcode.com/problems/move-zeroes/submissions
 *
 * Solution - O(n)
 *
 * Steps:
 * 1. Iterate through each element of array
 * 2. Check if current element is equals to 0, then remove 0 and add 0 to the end of array
 * 3. Return $nums result
 */
function moveZeroes(&$nums)
{
    for ($i = 0; $i < count($nums); $i++) {
        if ($nums[$i] === 0) {
            unset($nums[$i]);
            $nums[] = 0;
        }
    }

    return $nums;
}

