<?php


$numbers = [5, 10, 6, 1, 7, 3, 8, 4, 2, 9];
function mySelectionSort(array $array)
{
    $length = count($array);
    for ($i = 0; $i < $length; $i++) {
        // Finding the minimum value
        $min = $i;
        for ($j = $i + 1; $j < $length; $j++) {
            if ($array[$j] < $array[$min]) {
                $min = $j;
            }
        }

        // Swapping
        $temp = $array[$i];
        $array[$i] = $array[$min];
        $array[$min] = $temp;
    }

    return $array;
}

print_r(mySelectionSort($numbers)); // [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]