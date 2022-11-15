<?php

/**
 * Implementation with arrays (requires using references (aliases)).
 * Because of that, I recommend to use objects instead of arrays(associative)
 */
class LinkedListWithArrayNodes
{
    private ?array $head = [];
    private ?array $tail = [];
    private int $length = 0;
    public function __construct($value)
    {
        $this->head = [
            'value' => $value,
            'next' => null
        ];

        /**
         * Create a reference (alias) to this value - [value => $value, next => null] in memory
         * Then we can access this value with different names
         * Example: $this->head gives us same value as $this->tail
         * and if we change value $this->head['value'] = 99 value in memory,
         * then if we access $this->tail['value'] it will be 99 because value in memory changed
         */
        $this->tail =& $this->head;
        $this->length++;
    }

    public function append($value)
    {
        if (empty($tail)) {

        }

        /** Create a $tail variable with new values */
        $tail = [
            'value' => $value,
            'next' => null
        ];

        /**
         * Create a reference (alias) to this value - [value => $value, next => null] in memory
         * Because $this->tail references the same value as $this->head in memory (if it is second element on linked list)
         * when we change $this->tail['next'] in memory and access $this->head['next'] value will be changed (aliases)
         */
        $this->tail['next'] =& $tail;

        /**
         * Now $this->tail references to the same value in memory as $this->head
         * Because of it we need to remove $this->tail alias
         * unset() will not delete the actual value in memory because we have one more reference (alias) to this value in memory ($this->head)
         * instead, unset() will just remove reference (alias) to previous value
         */
        unset($this->tail);

        /**
         * Now we create a new reference (alias) to value - [value => $value, next => null]
         */
        $this->tail =& $tail;
        $this->length++;
    }

    public function prepend($value)
    {
        /**
         * Create a $head variable with new values
         * Also, create a reference for $this->head values
         */
        $head = [
            'value' => $value,
            'next' => &$this->head
        ];
        /**
         * Delete reference (alias) instead of deleting actual value in memory
         */
        unset($this->head);

        $this->head = $head;
        $this->length++;
    }

    public function count()
    {
        return $this->length;
    }

    public function print()
    {
        $node = $this->head;

        while (!is_null($node)) {
            echo !is_null($node['next'])
                ? $node['value'] . ' --> '
                : $node['value'];

            $node = $node['next'];
        }
    }

}


$linkedList = new LinkedListWithArrayNodes(10);
$linkedList->append(5); // O(1)
$linkedList->prepend(15); // O(1)
$linkedList->count(); // 3

$linkedList->print(); // 15 --> 10 --> 5


