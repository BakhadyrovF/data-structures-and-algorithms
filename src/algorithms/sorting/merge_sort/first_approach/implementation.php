<?php


$numbers = [9, 7, 4, 1, 5, 6, 2, 10, 3, 8];

class MyMergeSort
{
    public function sort(array $array): array
    {
        if (count($array) === 1) {
            return $array;
        }

        $middle = floor(count($array) / 2);
        $left = array_slice($array, 0, $middle);
        $right = array_slice($array, $middle);

        // This piece of code breaks my mind.
        // call function merge() and provide arguments with calling sort() recursively, but here is a trick,
        // sort() returns what the merge() function returns, so merge() function takes what it returns
        return $this->merge(
            $this->sort($left),
            $this->sort($right)
        );
    }

    private function merge(array $left, array $right): array
    {
        $result = [];
        $leftIndex = 0;
        $rightIndex = 0;

        // common merging two arrays
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
}

$mergeSort = new MyMergeSort();
print_r($mergeSort->sort($numbers)); // [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
