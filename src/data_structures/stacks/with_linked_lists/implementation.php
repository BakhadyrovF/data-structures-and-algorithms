<?php

require_once __DIR__ . '/Node.php';

class Stack
{
	public ?Node $top = null;
	public ?Node $bottom = null;
	public int $length = 0;

	public function push($value)
	{
		$newNode = new Node($value);

		if ($this->isEmpty()) {
			$this->top = $newNode;
			$this->bottom = $newNode;
		} else {
			$newNode->setNext($this->top);
			$this->top = $newNode;
		}
		$this->length++;
	}

	public function peek()
	{		
		return $this->top;
	}

	public function pop()
	{
		if ($this->isEmpty()) {
			return;
		} 

		if ($this->length === 1) {
			$this->top = null;
			$this->bottom = null;
		} else {
			$this->top = $this->top->getNext();
		}

		$this->length--;
	}

	public function isEmpty() {
		return $this->length === 0;
	}

	public function printList()
	{
		$node = $this->top;
		$result = '';

		while ($node) {
			$result .= $node->getValue() . ' -> ';
			$node = $node->getNext();
		}

		echo $result . PHP_EOL;
	}
}

$stack = new Stack();
$stack->push('google');
$stack->push('udemy');
$stack->push('discord');

$stack->pop();
$stack->pop();
$stack->pop();
