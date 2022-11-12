<?php

class MyArray
{
    private int $length = 0;
    private array $data = [];

    /** Creating new array object with given items, items also can be null */
    public function __construct(...$items)
    {
        $this->length = count($items);
        $this->data = $items;
    }

    /**
     * Get all items
     */
    public function data()
    {
        return $this->data;
    }

    /**
     * Get a length of array, in php it is called count()
     */
    public function count()
    {
        return $this->length;
    }

    /**
     * Get item from given index
     */
    public function get($index)
    {
        return $this->data[$index];
    }

    /**
     * Set item to given index
     */
    public function set($index, $value)
    {
        return $this->data[$index] = $value;
    }

    /**
     * In php complexity of push is O(n), because we can add more than one item
     */
    public function push(...$values)
    {
        for ($i = 0; $i < count($values); $i++) {
            $this->data[] = $values[$i];
            $this->length++;
        }

    }

    /**
     * Shift items started from given index
     */
    public function shift($index = 0)
    {
        for ($i = $index; $i < $this->length - 1; $i++) {
            $this->data[$i] = $this->data[$i + 1];
        }

        unset($this->data[$this->length -  1]);
        $this->length--;
    }
}


$newArray = new MyArray(1, 2, 3); // [1, 2, 3]
$newArray->push(4, 5); // [1, 2, 3, 4, 5]
$newArray->shift(2); // [1, 2, 4, 5]
$newArray->get(2); // 4
$newArray->set(2, 3); // [1, 2, 3, 5]
$newArray->shift(3); // [1, 2, 3]
$newArray->count(); // 3
