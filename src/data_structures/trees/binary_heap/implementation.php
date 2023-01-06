<?php



class MyMaxHeap
{
    private array $heap = [];

    public function heapify(array $values)
    {
        for ($i = 0; $i < count($values); $i++) {
            $this->insert($values[$i]);
        }
    }

    public function extractMax()
    {
        // If Heap is empty, return null
        if (count($this->heap) < 1) {
            return null;
        }

        // Take the max value from Heap
        $max = $this->heap[0];

        // If we have no elements in Heap other than max, then our Heap will be new empty array
        if (count($this->heap) === 1) {
            $this->heap = [];

            return $max;
        }
        // Otherwise, just call already implemented delete function to delete our max element from Heap
        $this->delete(0);

        // after delete and bubble down, we can return max
        return $max;
    }

    public function insert(int $value)
    {
        // Push value to the end of the Heap
        // We are not using keys (priority keys), instead we are using array indices so,
        // for the Heap to work correctly, we must not allow holes in our array
        $this->heap[count($this->heap)] = $value;

        // If pushed value is the root, then no heapify needed
        if (count($this->heap) === 1) {
            return true;
        }

        return $this->bubbleUp(count($this->heap) - 1);
    }

    public function delete(int $index)
    {
        // if value that should be deleted is not valid, return false
        $lastIndex = count($this->heap) - 1;
        if ($index > $lastIndex) {
            return false;
        }

        // if value that should be deleted is last value of the Heap, then just remove it, no heapify needed
        if ($index === $lastIndex) {
            unset($this->heap[$lastIndex]);

            return true;
        }

        // swap value that should be deleted with last value of Heap
        $this->heap[$index] = $this->heap[$lastIndex];

        // remove last value of Heap
        unset($this->heap[$lastIndex]);

        return $this->bubbleDown($index);
    }

    public function getHeap()
    {
        return $this->heap;
    }

    protected function bubbleUp($index)
    {
        // Take parent index with its value, for the given index
        $value = $this->heap[$index];
        $parentIndex = $this->getParentIndex($index);
        $parentValue = $this->heap[$parentIndex] ?? null;

        // if newly pushed value is greater than its parent, swap them and continue heapifying
        if ($parentValue !== null && $value > $parentValue) {
            $this->heap[$parentIndex] = $value;
            $this->heap[$index] = $parentValue;

            $index = $parentIndex;
            return $this->bubbleUp($index);
        }

        // Otherwise our Heap is heapified, just return true
        return true;
    }

    protected function bubbleDown($index)
    {
        // take left and right child
        $value = $this->heap[$index];
        $leftChildIndex = $this->getChildIndex($index, 'l');
        $leftChildValue = $this->heap[$leftChildIndex] ?? null;
        $rightChildIndex = $this->getChildIndex($index, 'r');
        $rightChildValue = $this->heap[$rightChildIndex] ?? null;

        // take the greatest child between left and right
        if ($leftChildValue > $rightChildValue) {
            $maxIndex = $leftChildIndex;
            $maxValue = $leftChildValue;
        } else {
            $maxIndex = $rightChildIndex;
            $maxValue = $rightChildValue;
        }

        // if the greatest child (left\right) is greater than current value, swap them and continue heapifying
        if ($value < $maxValue) {
            $this->heap[$maxIndex] = $value;
            $this->heap[$index] = $maxValue;

            return $this->bubbleDown($maxIndex);
        }

        // Otherwise Heap is heapified, just return true
        return true;
    }

    protected function getParentIndex(int $index)
    {
        // formula for getting parent for given index
        return floor(($index - 1) / 2);
    }

    protected function getChildIndex($index, $side)
    {
        // formula for getting children for given index
        return $side === 'l'
            ? $index * 2 + 1
            : $index * 2 + 2;
    }
}

$myBinaryHeap = new MyMaxHeap();
$myBinaryHeap->heapify([33,20,27,45,13]);
$myBinaryHeap->insert(20);
$myBinaryHeap->insert(56);
$myBinaryHeap->extractMax();
$myBinaryHeap->extractMax();

print_r($myBinaryHeap->getHeap());