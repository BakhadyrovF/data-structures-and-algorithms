<?php

require_once __DIR__ . '/Node.php';



class MyBinarySearchTree
{	
	public ?Node $root;
	public int $nodesCount = 0;

	public function insert($value)
	{
		if ($this->nodesCount === 0) {
			$this->root = new Node($value);
			$this->nodesCount++;
		} else {
			$this->traverseAndInsert($this->root, $value);		
			$this->nodesCount++;	
		}
	}

	protected function traverseAndInsert(Node $parentNode, $value) 
	{
		if ($value > $parentNode->getValue()) {
			$newParentNode = $parentNode->getRight();
			if ($parentNode->getRight() === null) {
				$parentNode->setRight(new Node($value));
				
				return true;
			} 
		} else {
			$newParentNode = $parentNode->getLeft();
			if ($newParentNode === null) {
				$parentNode->setLeft(new Node($value));
			
				return true;
			}
		}

		$this->traverseAndInsert($newParentNode, $value);
	}

	public function search($value)
	{
		return $this->traverseAndSearch($this->root, $value);
	}

	protected function traverseAndSearch($node, $value)
	{
		if ($node === null) {
			return -1;
		} 

		if ($value === $node->getValue()) {
			return $node;
		}

		if ($value > $node->getValue()) {
			$node = $node->getRight();
		} else {
			$node = $node->getLeft();
		}

		return $this->traverseAndSearch($node, $value);
	}

}

$myBinarySearchTree = new MyBinarySearchTree();
$myBinarySearchTree->insert(3);
$myBinarySearchTree->insert(9);
$myBinarySearchTree->insert(15);
$myBinarySearchTree->insert(35);
$myBinarySearchTree->insert(14);

print_r($myBinarySearchTree->search(15));

//print_r($myBinarySearchTree);
