<?php

$array = [1, 3, 4, 6, 10];
$sum = 16;

/**
 * Two Sum
 * @link https://leetcode.com/problems/two-sum/description
 *
 * Solution - O(n)
 *
 * Steps:
 * 1. Initialize new empty array variable $cache
 * 2. Iterate each element of array
 * 3. Check if $cache has element in index ($sum - $array[$i]) then return indices
 * 4. Else ($cache has no element in this index) then we add value of $i for index ($sum - $array[$i]) to $cache array
 *
 * Time complexity is O(n)
 * Space complexity is O(n)
 */
function twoSum(array $array, int $sum)
{
    $cache = [];

    for ($i = 0; $i < count($array); $i++) {
        if (isset($cache[$array[$i]])) {
            return [$cache[$array[$i]], $i];
        }

        $cache[$sum - $array[$i]] = $i;
    }

    return -1;
}
