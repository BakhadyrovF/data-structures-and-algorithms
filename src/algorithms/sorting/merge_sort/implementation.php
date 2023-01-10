<?php


$numbers = [2, 1];

function myMergeSort(array $array)
{
    // recursion will work till we have no
    if (count($array) === 1) {
        return $array;
    }

    $middle = floor(count($array) / 2);
    $left = array_slice($array, 0, $middle);
    $right = array_slice($array, $middle);

    // This piece of code breaks my mind.
    // call function merge() and provide arguments with calling myMergeSort() recursively, but here is a trick,
    // myMergeSort() returns what the merge() function returns, so merge() function takes what it returns
    return merge(
        myMergeSort($left),
        myMergeSort($right)
    );
}

function merge(array $left, array $right)
{
    $result = [];
    $leftIndex = 0;
    $rightIndex = 0;

    while ($leftIndex < count($left) || $rightIndex < count($right)) {
        $leftValue = $left[$leftIndex] ?? null;
        $rightValue = $right[$rightIndex] ?? null;
        if (is_null($rightValue) || isset($leftValue) && $left[$leftIndex] < $right[$rightIndex]) {
            $result[] = $left[$leftIndex];
            $leftIndex++;
        } else {
            $result[] = $right[$rightIndex];
            $rightIndex++;
        }
    }

    return $result;
}

print_r(myMergeSort($numbers));

//merge([1, 2], [3, 4]);