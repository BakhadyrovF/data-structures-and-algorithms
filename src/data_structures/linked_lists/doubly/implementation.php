<?php

require_once __DIR__ . '/Node.php'; // Import Node class

final class DoublyLinkedList
{
    private ?Node $head;
    private ?Node $tail;
    private int $length = 0;

    public function __construct($value)
    {
        $this->head = new Node($value);
        $this->tail = $this->head;
        $this->length++;
    }

    public function append($value)
    {
        $tail = new Node($value, $this->tail);

        $this->tail->setNext($tail);

        $this->tail = $tail;
        $this->length++;
    }

    public function prepend($value)
    {
        $head = new Node($value, next: $this->head);

        $this->head->setPrevious($head);

        $this->head = $head;
        $this->length++;
    }

    public function insert($value, $index)
    {
        if ($index > $this->length) {
            return false;
        }


        if ($index === 0) {
            $this->prepend($value);
        } elseif ($index === $this->length) {
            $this->append($value);
        }

        /**
         * For example - we have doubly linked list with these nodes:
         *  10 -> 5 -> 3 -> 1
         * and we want to insert value 2 at index 3, result should be - 10 -> 5 -> 3 -> 2 -> 1
         */
        // Retrieve element in index 3 in our case it is 1
        $nodeAtGivenIndex = $this->traverseTo($index);

        // Create new node with given value, set previous node of new node to previous node of node with value 1
        // and set next node of new node to node with value 1.
        // 3 <- 2 -> 1
        $newNode = new Node($value, $nodeAtGivenIndex->getPrevious(), $nodeAtGivenIndex);

        // Get previous node that we set before (3) and set next node to our new node (2).
        //  3 -> 2
        $newNode->getPrevious()->setNext($newNode);

        // finally, set previous node of node with value (1) to our new node (2).
        // 2 <- 1
        $nodeAtGivenIndex->setPrevious($newNode);

        $this->length++;

        // That's it result would be (only changed nodes):
        // 3 -> <- 2 -> <- 1
        return true;
    }

    public function delete($index)
    {
        if ($index > $this->length - 1) {
            return false;
        }

        /**
         * For example - we have doubly linked list with these nodes:
         *  10 -> 5 -> 4 -> 3
         * we want to delete node in index 2 with value 4
         */

        // Get a node in index 2 with value 4 (Iteration started from tail, because it is more efficient for our case)
        $deletableNode = $this->traverseTo($index);

        // 1. Get a previous node (5)
        // 2. Set next node (3)
        // 5 -> 3
        $deletableNode->getPrevious()?->setNext($deletableNode->getNext());

        // 1. Get a next node (3)
        // 2. Set previous node (5)
        // 5 <- 3
        $deletableNode->getNext()?->setPrevious($deletableNode->getPrevious());

        // Finally, return true, because now we have no pointers for deletable Node object,
        // so php garbage collector will remove this object from memory
        return true;
    }

    protected function traverseTo($index)
    {
        $middle = floor(($this->length - 1) / 2); // floor() rounds down -> 5 / 2 = 2

        if ($index  <= $middle) {
            return $this->traverseFromHead($index);
        }

        return $this->traverseFromTail($index);
    }

    protected function traverseFromHead($index)
    {
        $node = $this->head;

        $i = 0;
        while ($i < $index) {
            $node = $node->getNext();
            $i++;
        }

        return $node;
    }

    protected function traverseFromTail($index)
    {
        $node = $this->tail;
        $i = $this->length - 1;

        while ($i > $index) {
            $node = $node->getPrevious();
            $i--;
        }

        return $node;
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

$doublyLinkedList = new DoublyLinkedList(5);
$doublyLinkedList->append(3); // O(1) (5 -> 3)
$doublyLinkedList->prepend(10); // O(1) (10 -> 5 -> 3)
$doublyLinkedList->insert(4, 2); // O(1) - iterations number - 0, because we took tail (10 -> 5 -> 4 -> 3)
$doublyLinkedList->delete(2); // O(n) - iterations number - 1, because we started from tail (10 -> 5 -> 3)
$doublyLinkedList->print(); // 10 -> 5 -> 3

