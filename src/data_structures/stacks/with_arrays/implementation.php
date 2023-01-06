<?php



class MyArrayStack
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

		array_pop($this->elements);
	}

	public function peek()
	{
		if (empty($this->elements)) {
			return null;
		}

		return $this->elements[count($this->elements) - 1];
	}
}

$stack = new MyArrayStack();
$stack->push('google');
$stack->push('udemy'); 
$stack->push('discord');

$stack->pop();
$stack->pop();
$stack->pop();


