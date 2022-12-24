<?php

class Node
{
	private ?self $left;
	private ?self $right;
	private $value;

	public function __construct($value, ?self $right = null, ?self $left = null) 
	{
		$this->value = $value;
		$this->right = $right;
		$this->left = $left;
	}

	public function getRight()
	{
		return $this->right;
	}

	public function setRight(?self $right)
	{
		$this->right = $right;
	}

	public function getLeft()
	{
		return $this->left;
	}

	public function setLeft(?self $left)
	{
		$this->left = $left;
	}

	public function getValue()
	{
		return $this->value;
	}

	public function setValue($value)
	{
		$this->value = $value;
	}
}