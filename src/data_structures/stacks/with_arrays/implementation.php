<?php



class Stack
{	
	public array $elements = [];

	public function push($value) 
	{
		$this->elements[] = $value;
	}

	public function pop()
	{
		if (empty($this->elements)) {
			return;
		}

		unset($this->elements[count($this->elements) - 1]);
	}

	public function peek()
	{
		if (empty($this->elements)) {
			return null;
		}

		return $this->elements[count($this->elements) - 1];
	}
}

$stack = new Stack();
$stack->push('google');
$stack->push('udemy'); 
$stack->push('discord');

$stack->pop();
$stack->pop();
$stack->pop();


