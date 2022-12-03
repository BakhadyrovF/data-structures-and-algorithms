<?php

/**
 * Question that asked by developer on Google in mock-interview with a Meta Intern
 * Link to the video: @link https://www.youtube.com/watch?v=46dZH7LDbf8
 *
 * Design a class:
 *  Items are unordered integers
 *  1. Insert - (Insert given value, index is not given, could contain duplicates, values are integers only)
 *  2. Remove - (By given value not index)
 *  3. Get a random value that is already inserted (with equal probability, built-in functions allowed, you can assume that built-in function is O(1))
 *
 * Time complexity:
 *  Insert - O(1)
 *  Remove - O(1)
 *  Get a random value - O(1)
 *
 * Space complexity:
 *  Does not matter
 */


/**
 * Solution goes here, but I advise you to try it yourself
 */
class Store
{
    public array $values = [];
    public array $map = [];

    public function insert(int $value)
    {
        $lastIndex = count($this->values);
        if (in_array($value, $this->values)) {
            $this->values[] = $value;
            $this->map[$value][$lastIndex] = $lastIndex; // Emulating "Sets" Data Structure in PHP, so then we can delete specific item from index
        } else {
            $this->values[] = $value;
            $this->map[$value] = [$lastIndex => $lastIndex]; // Same here
        }
    }

    public function remove(int $value)
    {
        if (empty($this->map[$value])) {
            return;
        }

        $deletableIndex = $this->map[$value][array_key_first($this->map[$value])];
        $lastValue = $this->values[count($this->values) - 1];

        if ($value === $lastValue) {
            unset($this->map[$lastValue][count($this->values) - 1]);
            array_pop($this->values);

            return;
        }

        $this->values[$deletableIndex] = $lastValue;
        $this->map[$lastValue][$deletableIndex] = $deletableIndex;

        unset($this->map[$value][$deletableIndex]);
        unset($this->map[$lastValue][count($this->values) - 1]);
        array_pop($this->values);
    }
    public function getRandom()
    {
        return array_rand($this->values);
    }
}


$store = new Store();
$store->insert(3);
$store->insert(4);
$store->insert(4);
$store->insert(5);
$store->remove(4);

print_r($store->map); // [3 => [0 => 0], 4 => [2 => 2], 5 => [1 => 1]]
print_r($store->values); // [3, 5, 4]