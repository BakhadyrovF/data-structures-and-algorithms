<?php

/**
 * Quick Sort
 * Implemented only with knowledge of how the algorithm works (without learning other implementation),
 * so it might not be the best implementation.
 * Again, here I use last element of range as a pivot, and here is the problem,
 * It will cause O(n^2) for nearly sorted or descending sorted arrays, so instead of taking last element as a pivot,
 * we should use MO3.
 *
 * Time Complexity - (n log n)
 * Space Complexity - O(log n)
 */
class MyQuickSort
{
    private array $array;

    public function __construct(array $array)
    {
        $this->array = $array;
    }

    public function sort()
    {
        $pivot = count($this->array) - 1;
        $start = 0;

        // call recursive method to divide whole array to 2 parts
        $this->quickSort($start, $pivot);

        return $this->array;
    }

    public function quickSort(int $start, int $pivot): void
    {
        // recursion will work till start is less than pivot
        if ($start >= $pivot) {
            return;
        }

        $first = $start;
        $last = $pivot;

        while ($start < $pivot) {
            // if start is greater than pivot
            if ($this->array[$start] > $this->array[$pivot]) {
                // check if start is next to pivot, then just swap them without involving third item
                if ($pivot - 1 === $start) {
                    // swap two elements as usual
                    $temp = $this->array[$start];
                    $this->array[$start] = $this->array[$pivot];
                    $this->array[$pivot] = $temp;
                } else {
                    // else, we should do three swaps:
                    // 1. swap start with pivot (start is greater, so it should be on the right side)
                    // 2. swap pivot with element that stays next to (previous by array order)
                    // 3. swap element that stays next to with start
                    // example: [7, 4, 3] -> pivot: 3, prev: 4, start: 7
                    // result after swapping must be - [4, 3 ,7]

                    // store values to temporary variables
                    $prev = $this->array[$pivot - 1];
                    $current = $this->array[$pivot];

                    // swap them
                    $this->array[$pivot] = $this->array[$start];
                    $this->array[$pivot - 1] = $current;
                    $this->array[$start] = $prev;
                }
                // if start is higher, swap will be performed anyway, so we should decrement our pivot
                $pivot--;
            } else {
                // start is less than pivot, so we can move to the next element without swapping
                $start++;
            }
        }

        // now after all operations, we are sure that pivot is in the right position
        // so, we divide array to 2 parts and call sort method for each of them
        $this->quickSort($first, $pivot - 1);
        $this->quickSort($pivot + 1, $last);
    }
}

$myQuickSort = new MyQuickSort([7, 1, 9 ,5, 10, 4, 8, 2, 6, 3]);
print_r($myQuickSort->sort()); // [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]