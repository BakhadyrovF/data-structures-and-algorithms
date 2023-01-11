<?php




/**
 *
 * Wrote this second approach from scratch for better understanding how recursion and merge-sort work.
 *
 * Time Complexity - O(n log n)
 * Space Complexity - O(n)
 */
class MyMergeSort
{
    private array $array;

    public function __construct(array $array)
    {
        // initialize private property, so we can access it from everywhere in our class
        $this->array = $array;
    }

    public function sort()
    {
        $length = count($this->array);
        $left = 0;
        $right = $length - 1;

        $middle = floor(($left + $right) / 2);

        // call recursively method twice (for both parts)
        $this->mergeSort($left, $middle);
        $this->mergeSort($middle + 1, $right);

        // now all sub-problems are solved (array portions are sorted)
        // we can call merge for the last time (divide and conquer)
        $this->merge($left, $middle, $right);

        return $this->array;
    }

    private function mergeSort(int $left, int $right): void
    {
        // recursion will work till left index is smaller than right index
        if ($left >= $right) {
            return;
        }

        // take the middle of given left, right
        $middle = floor(($left + $right) / 2);

        // call method recursively for both parts
        $this->mergeSort($left, $middle);
        $this->mergeSort($middle + 1, $right);

        // like we did before, call merge for two sorted sub-arrays
        // merge every sorted sub array, from bottom to top.
        $this->merge($left, $middle, $right);
    }

    public function merge(int $left, int $middle, int $right)
    {
        // initialize array for storing sorted elements
        $sortedPortion = [];

        // middle is the last value of the left side, so +1 gives us first value of the right side
        $temp = $middle + 1;

        // also we should store left value, because we will use it after sorting to change original array
        $firstIndex = $left;

        // simple merging two sorted arrays
        while ($left <= $middle || $temp <= $right) {
            $leftValue = $left > $middle ? null : $this->array[$left];
            $rightValue = $temp > $right ? null : $this->array[$temp];

            if (is_null($rightValue) || isset($leftValue) && $leftValue < $rightValue) {
                $sortedPortion[] = $leftValue;
                $left++;
            } else {
                $sortedPortion[] = $rightValue;
                $temp++;
            }
        }

        // now we can push all sorted values, to the original array starting from the first index that was given
        for ($i = 0; $i < count($sortedPortion); $i++) {
            $this->array[$firstIndex] = $sortedPortion[$i];
            $firstIndex++;
        }
    }
}

$mergeSort = new MyMergeSort([7, 3, 10, 6, 1, 5, 9, 2, 4, 8]);
print_r($mergeSort->sort()); // [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]

