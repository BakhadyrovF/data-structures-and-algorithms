<?php

// import Binary Search Tree
require_once __DIR__ . '/../../../../data_structures/trees/binary_search_tree/implementation.php';

class MyBreadthFirstSearch
{
    public function search(Node $node)
    {
        $result = [];
        $queue = [$node];

        while (!empty($queue)) {
            $currentNode = array_shift($queue);

            if ($currentNode === null) {
                continue;
            }

            $result[] = $currentNode->getValue();

            $queue[] = $currentNode->getLeft();
            $queue[] = $currentNode->getRight();
        }

        return $result;
    }

    public function searchRecursively(Node $node)
    {
        $result = [];
        $queue = [$node];

        $this->exploreTheNode($queue, $result);

        return $result;
    }

    protected function exploreTheNode(array &$queue, array &$result)
    {
        if (empty($queue)) {
            return true;
        }

        $currentNode = array_shift($queue);

        $result[] = $currentNode->getValue();

        if ($currentNode->getLeft() !== null) {
            $queue[] = $currentNode->getLeft();
        }

        if ($currentNode->getRight() !== null) {
            $queue[] = $currentNode->getRight();
        }

        $this->exploreTheNode($queue, $result);
    }
}

// Initializing Binary Search Tree
$bst = new MyBinarySearchTree();
$bst->insert(27);
$bst->insert(18);
$bst->insert(33);
$bst->insert(9);
$bst->insert(21);
$bst->insert(40);

$bfs = new MyBreadthFirstSearch();
// Call iterative approach
print_r($bfs->search($bst->root));
// Call recursive approach
print_r($bfs->searchRecursively($bst->root));