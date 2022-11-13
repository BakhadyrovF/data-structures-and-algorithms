<?php

$nums = [1, 2, 3, 4, 5, 1];

/**
 * Contains Duplicate
 * @link https://leetcode.com/problems/contains-duplicate/description
 *
 * Solution - O(n)
 *
 * Steps:
 * 1. Initialize empty array variable $items
 * 2. Iterate through each number in array $nums
 * 3. Check if $items array contains element with index ($nums[$i]) - current number, then return true (has duplicates)
 * 4. Else ($items array not contains element with this index) then add bool(true) to $items array in index ($nums[$i]) - current number
 * 5. Return false if loop is not returns true (has no duplicates)
 */
function containsDuplicate(array $nums)
{
    $items = [];

    for ($i = 0; $i < count($nums); $i++) {
        if (isset($items[$nums[$i]])) {
            return true;
        }

        $items[$nums[$i]] = true;
    }

    return false;
}