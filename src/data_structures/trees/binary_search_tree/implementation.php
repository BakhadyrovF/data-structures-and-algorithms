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

	public function lookup($value)
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

	public function remove($value)
	{
		$parentNode = $this->root;

		if ($parentNode->getValue() === $value) {
			// Removing the root
			if ($parentNode->getRight() === null) {
				$this->root = $parentNode->getLeft();
			} else {				
				$successor = $this->findSuccessor($parentNode);

				$this->root = $successor;
			}

			return true;
		}

		if ($value > $parentNode->getValue()) {
			$node = $parentNode->getRight();
		} else {
			$node = $parentNode->getLeft();
		}

		return $this->traverseAndRemove($parentNode, $node, $value);
	}

	protected function traverseAndRemove($parentNode, $node, $value) 
	{
		if ($node === null) {
			return false;
		}

		if ($value === $node->getValue()) {
			if ($node->getRight() === null || $node->getLeft() === null) {
				// Have not children or have only 1, so we do not need to find inorder successor.
				$children = $node->getRight() ?? $node->getLeft();

				// Determine in which side is this node
				if ($node->getValue() > $parentNode->getValue()) {
					$parentNode->setRight($children);
				} else {
					$parentNode->setLeft($children);
				}
			} else {

				// Have two children and we need to find inorder successor.
				$successor = $this->findSuccessor($node);

				// Determine in which side is this node
				if ($node->getValue() > $parentNode->getValue()) {
					$parentNode->setRight($successor);
				} else {
					$parentNode->setLeft($successor);
				}
				
			}

			return true;
		} 

		$parentNode = $node;
		if ($value > $node->getValue()) {	
			$node = $node->getRight();
		} else {
			$node = $node->getLeft();
		}

		$this->traverseAndRemove($parentNode, $node, $value);
	}

	protected function findSuccessor($node)
	{
		// 1 step to the right and traverse to the left till you can

		$currentNode = $node; // deletable current node
		$parentNode = $node->getRight();
		$node = $parentNode->getLeft();

		if ($node === null) {
			// On the left we have not nodes, so our successor is node that stays in 1 step to the right
			$parentNode->setLeft($currentNode->getLeft());

			return $parentNode;
		}

		while ($node->getLeft()) {
			$parentNode = $node;
			$node = $node->getLeft();
		}
		
		// Getting only right because we exactly know that on the left side we have nothing
		$parentNode->setLeft($node->getRight()); 
		
		// Take all values from deletable node and set it to its successor
		$node->setLeft($currentNode->getLeft());
		$node->setRight($currentNode->getRight());

		return $node;
	}

	public function toHashMap($node)
	{
		$tree = ['value' => $node->getValue()];

		$tree['left'] = $node->getLeft() === null ? null : $this->toHashMap($node->getLeft());
		$tree['right'] = $node->getRight() === null ? null : $this->toHashMap($node->getRight());

		return $tree;
	}

	public function toJson()
	{
		return json_encode($this->toHashMap($this->root), true);
	}

}

$myBinarySearchTree = new MyBinarySearchTree();
$myBinarySearchTree->insert(9);
$myBinarySearchTree->insert(4);
$myBinarySearchTree->insert(6);
$myBinarySearchTree->insert(20);
$myBinarySearchTree->insert(170);
$myBinarySearchTree->insert(15);
$myBinarySearchTree->insert(1);
$myBinarySearchTree->insert(21);

// print_r($myBinarySearchTree->lookup(20));

$myBinarySearchTree->remove(1);
$myBinarySearchTree->remove(4);
$myBinarySearchTree->remove(20);

$myBinarySearchTree->insert(30);
$myBinarySearchTree->insert(35);
$myBinarySearchTree->insert(40);
$myBinarySearchTree->insert(29);
$myBinarySearchTree->insert(25);
$myBinarySearchTree->insert(18);

$myBinarySearchTree->remove(21);
$myBinarySearchTree->remove(9);

header('Content-Type: application/json');
echo $myBinarySearchTree->toJson();




