<?php

require_once __DIR__ . '/../Node.php'; // Import Node class

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
            $i = 0;
            $previous = $this->head;

            while ($i < $index - 1) {
                $previous = $previous->getNext();
                $i++;
            }

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
                : $node->getValue();

            $node = $node->getNext();
        }
    }
}

$singlyLinkedList = new SinglyLinkedList(10);
$singlyLinkedList->append(5); // O(1)
$singlyLinkedList->prepend(15); // O(1)
$singlyLinkedList->print(); // 15 -> 10 -> 5


$singlyLinkedList->insert(7, 2); // O(n)
$singlyLinkedList->print(); // 15 -> 10 -> 7 -> 5

