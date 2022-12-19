<?php

require_once __DIR__ . '/../../stacks/with_linked_lists/Node.php';


class Queue
{
	public ?Node $first = null;
	public ?Node $last = null;
	public int $length = 0;

	public function enqueue($value)
	{
		$newNode = new Node($value);
		if ($this->length === 0) {
			$this->first = $newNode;
			$this->last = $newNode;
		} else {
			$this->last->setNext($newNode);
			$this->last = $newNode;
		}

		$this->length++;
	}  

	public function dequeue()
	{
		if ($this->length === 0) {
			return;
		}

		if ($this->length === 1) {
			$this->last = null;
		}

		$this->first = $this->first->getNext();
		$this->length--;
	}

	public function printQueue()
	{
		$currentInQueue = $this->first;

		while ($currentInQueue) {
			echo $currentInQueue->getValue() . ' -> ';
			$currentInQueue = $currentInQueue->getNext();
		}
	}

	public function peek()
	{
		if ($this->length === 0) {
			return null;
		}

		return $this->first->getValue();
	}
}

$queue = new Queue();
$queue->enqueue('Firuzbek Bakhadyrov');
$queue->enqueue('Wolter White');
$queue->enqueue('Anthony Soprano');

$queue->dequeue();
$queue->dequeue();

echo $queue->peek(); // Anthony Soprano
// $queue->printQueue();

