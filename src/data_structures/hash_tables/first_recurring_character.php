<?php

$items = [2, 5, 1, 2, 3, 5, 1, 2, 4];
// Given an array = [2, 5, 1, 2, 3, 5, 1, 2, 4]
// Should return 2
// Because 2 is recurs first

/**
 * Solution - O(n)
 *
 * Steps:
 * 1. Initialize empty array variable $cache
 * 2. Iterate through each number in array $items
 * 3. Check if $cache array contains element with index ($items[$i]) - current number, then return $items[$i] first recurring item
 * 4. Else ($cache array not contains element with this index)
 *    then add bool(true) to $cache array in index ($items[$i]) - current number
 * 5. Return null if loop is not return anything (has no recurring item)
 */
function firstRecurringCharacter(array $items)
{
    $cache = [];

    for ($i = 0; $i < count($items); $i++) {
        if (isset($cache[$items[$i]])) {
            return $items[$i];
        }

        $cache[$items[$i]] = true;
    }

    return null;
}

// Given an array of items - [2, 5, 1, 2, 3, 5, 1, 2, 4]
// Return the most recurring item and number of repetitions as an array
// Result: [2 (most recurring item), 3 (number of repetitions)]
// If number of repetitions is equal return first most recurring item

/**
 * Solution - O(n)
 * 
 * Steps:
 * 1. Initialize $cache temporary empty array
 * 2. Initialize $mostRecurringItem array with null values
 * 3. Iterate through each element of $items array
 * 4. Check if $cache array has element in index ($item) - current element,
 *    then increment $cache[$item]['repetitions'] value
 *    and also check if $cache[$item]['repetitions'] is greater than $mostRecurringItem['repetitions']
 *    then assign $cache[$item] to $mostRecurringItem
 * 5. Else (if $cache array has no element in index), then add new element to $cache in index $item - $cache[$item]
 *
 */
function mostRecurringCharacter(array $items)
{
    $cache = [];
    $mostRecurringItem = ['item' => null, 'repetitions' => 0];

    for ($i = 0; $i < count($items); $i++) {
        $item = $items[$i];
        if (isset($cache[$item])) {
            $cache[$item]['repetitions']++;
            if ($cache[$item]['repetitions'] > $mostRecurringItem['repetitions']) {
                $mostRecurringItem = $cache[$item];
            }
        } else {
            $cache[$item] = [
                'item' => $item,
                'repetitions' => 1
            ];
        }
    }

    return $mostRecurringItem;
}
