<?php

require_once __DIR__ . '/Node.php'; // Import Node class

final class SinglyLinkedList
{
    private ?Node $head;
    private ?Node $tail;

    private int $length = 0;

    public function __construct($head)
    {
        $this->head = new Node($head);
        $this->tail = $this->head;
        $this->length++;
    }

    public function reverse()
    {
        $first = $this->head;
        $second = $first->getNext();

        while ($second) {
            $third = $second->getNext();
            $second->setNext($first);
            $first = $second;
            $second = $third;
        }

        $head = $this->head;
        $tail = $this->tail;

        $this->head = $tail;
        $this->tail = $head;
        $this->tail->setNext(null);
    }

    public function insert($value, $index)
    {
        // If specified index is bigger than length of linked list, then return false
        if ($index > $this->length) {
            return false;
        }


        if ($index === 0) { // If index equals 0 then it is common prepend
            $this->prepend($value);
        } elseif ($index === $this->length) {
            $this->append($value); // If index equals $this->length (last element) then it is common append
        } else {
            // Else we traverse through each node until we reach $index - 1 node
            // it will be our previous node

            $previous = $this->traverseTo($index - 1); // index - 1 because we need node that stays before given index

            $current = new Node($value, $previous->getNext());
            $previous->setNext($current);
        }

        $this->length++;
        return true;
    }

    public function prepend($value)
    {
        $this->head = new Node($value, $this->head);
        $this->length++;
        return true;
    }

    public function append($value)
    {
        $tail = new Node($value);
        $this->tail->setNext($tail);

        $this->tail = $tail;
        $this->length++;

        return true;
    }

    public function remove($index)
    {
        if ($index > $this->length) {
            return false;
        }

        if ($index === 0) { // We will remove head node
            $this->head = $this->head->getNext();
        } else {
            $previousNode = $this->traverseTo($index - 1); // index - 1 because we need node that stays before given index
            $previousNode->setNext($previousNode->getNext()->getNext()); // get next node of current node and assign to the previous node
        }

        $this->length--;
        return true;

    }

    public function length()
    {
        return $this->length;
    }

    public function print()
    {
        $node = $this->head;

        while ($node) {
            echo $node->getNext()
                ? $node->getValue() . ' -> '
                : $node->getValue() . PHP_EOL;

            $node = $node->getNext();
        }
    }

    protected function traverseTo($index) // 1 2 3 4
    {
        $node = $this->head;
        $i = 0;

        while ($i < $index) {
            $node = $node->getNext();
            $i++;
        }

        return $node;
    }
}

$singlyLinkedList = new SinglyLinkedList(10);
$singlyLinkedList->append(5); // O(1)
$singlyLinkedList->prepend(15); // O(1)
$singlyLinkedList->print(); // 15 -> 10 -> 5

$singlyLinkedList->insert(7, 2); // O(n)
$singlyLinkedList->print(); // 15 -> 10 -> 7 -> 5

$singlyLinkedList->reverse();
$singlyLinkedList->print(); // 5 -> 7 -> 10 -> 15
