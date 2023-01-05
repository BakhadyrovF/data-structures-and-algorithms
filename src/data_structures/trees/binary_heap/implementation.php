<?php



class MyMaxHeap
{
    private array $heap = [];

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

        return $this->heapifyUp(count($this->heap) - 1);
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

        return $this->heapifyDown($index);
    }

    public function getHeap()
    {
        return $this->heap;
    }

    protected function heapifyUp($index)
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
            return $this->heapifyUp($index);
        }

        // Otherwise our Heap is heapified, just return true
        return true;
    }

    protected function heapifyDown($index)
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

            return $this->heapifyDown($maxIndex);
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
$myBinaryHeap->insert(10);
$myBinaryHeap->insert(5);
$myBinaryHeap->insert(7);
$myBinaryHeap->delete(2);
$myBinaryHeap->insert(6);
$myBinaryHeap->insert(8);
$myBinaryHeap->insert(9);
$myBinaryHeap->insert(15);
$myBinaryHeap->delete(1);

print_r($myBinaryHeap->getHeap());