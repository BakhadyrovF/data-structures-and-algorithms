<?php


/**
 * Heap Sort
 * Implemented only with knowledge of how the algorithm works (without learning other implementation),
 * so it might not be the best implementation.
 * Note: heapify(), bubbleUp(), bubbleDown() are the methods of the Binary Heap data structure.
 *
 * Time Complexity - O(n log n)
 * Space Complexity - O(1)
 */
class MyHeapSort
{
    public array $heap;

    public function __construct(array $array)
    {
        $this->heapify($array);
    }

    public function sort(): array
    {
        // array was heapified when we initialize object of the class, so we can start sorting
        $count = count($this->heap);

        for ($i = $count - 1; $i > 0; $i--) {
            // swap max with last
            $maxElement = $this->heap[0];
            $this->heap[0] = $this->heap[$i];
            $this->heap[$i] = $maxElement;

            // bubble down element that come from the last index
            $this->bubbleDown(0, $i - 1);
        }

        return $this->heap;
    }

    protected function heapify(array $array): void
    {
        for ($i = 0; $i < count($array); $i++) {
            // push to the heap
            $this->heap[] = $array[$i];

            // bubble up newly added element
            $this->bubbleUp($i);
        }
    }

    protected function bubbleUp(int $index): void
    {
        if ($index === 0) {
            return;
        }

        $parentIndex = floor(($index - 1) / 2);

        // if current node is greater than its parent, we should swap them
        if ($this->heap[$parentIndex] < $this->heap[$index]) {
            //swap
            $temp = $this->heap[$parentIndex];
            $this->heap[$parentIndex] = $this->heap[$index];
            $this->heap[$index] = $temp;

            // follow the steps above until the heap is heapified
            $this->bubbleUp($parentIndex);
        }
    }

    protected function bubbleDown(int $index, int $lastIndex): void
    {
        // take left and right children of current node
        $leftChildIndex = $index * 2 + 1;
        // we are not using auxiliary space, so we should check if one of the children of current node is greater than last index,
        // then we should not take it, because this element is already sorted
        $leftChild = $leftChildIndex > $lastIndex ? null : ($this->heap[$leftChildIndex] ?? null);
        $rightChildIndex = $index * 2 + 2;
        $rightChild = $rightChildIndex > $lastIndex ? null : ($this->heap[$rightChildIndex] ?? null);

        // take child with the highest value
        if ($leftChild > $rightChild) {
            $highestChildIndex = $leftChildIndex;
            $highestChild = $leftChild;
        } else {
            $highestChildIndex = $rightChildIndex;
            $highestChild = $rightChild;
        }

        // compare the highest child with current node
        if ($highestChild > $this->heap[$index]) {
            // swap them (bubble down)
            $this->heap[$highestChildIndex] = $this->heap[$index];
            $this->heap[$index] = $highestChild;

            // follow the steps above until the heap is heapified
            $this->bubbleDown($highestChildIndex, $lastIndex);
        }
    }
}

$myHeapSort = new MyHeapSort([3, 10, 4, 7, 6, 1, 8, 2, 5, 9]);
print_r($myHeapSort->sort()); // [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
