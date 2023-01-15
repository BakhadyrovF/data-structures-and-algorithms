<?php

// import Singly Linked List and its Node
require_once __DIR__ . '/../../linked_lists/singly/implementation.php';
require_once __DIR__ . '/../../linked_lists/singly/Node.php';

/**
 * Undirected, Unweighted, Acyclic Graph
 */
class MyAdjacencyList
{
    public array $graph = [];

    public function addVertex($vertex)
    {
        // new vertex without edges
        $this->graph[$vertex] = null;

        return true;
    }

    public function removeVertex($vertex)
    {
        // remove certain vertex from hash-table
        unset($this->graph[$vertex]);

        // remove edges of just removed vertex
        foreach ($this->graph as $edges) {
            $node = $edges?->head;

            if ($node && $node->getValue() === $vertex) {
                $edges->head = $node->getNext();
            } else {
                $nextNode = $node->getNext();
                while ($nextNode) {
                    if ($nextNode->getValue() === $vertex) {
                        $node->setNext($nextNode->getNext());
                    }
                    $node = $nextNode;
                    $nextNode = $nextNode->getNext();
                }
            }
        }

        return true;
    }

    public function addEdge($vertexOne, $vertexTwo)
    {
        $this->addConnection($vertexOne, $vertexTwo);
        $this->addConnection($vertexTwo, $vertexOne);

        return true;
    }

    public function removeEdge($vertexOne, $vertexTwo)
    {
        $this->removeConnection($vertexOne, $vertexTwo);
        $this->removeConnection($vertexTwo, $vertexOne);

        return true;
    }

    public function printGraph()
    {
        $result = '';
        foreach ($this->graph as $vertex => $edges) {
            $result .= "Vertex ($vertex) is connected to: ";
            $node = $edges?->head;

            while ($node) {
                $result .= "{$node->getValue()}, ";
                $node = $node->getNext();
            }

            $result .= PHP_EOL;
        }

        echo $result;
    }

    protected function  addConnection($vertexOne, $vertexTwo)
    {
        // take edges of first vertex
        $edges = $this->graph[$vertexOne] ?? null;

        if (!$edges) {
            // initialize new linked list with its first node
            $this->graph[$vertexOne] = new SinglyLinkedList($vertexTwo);
        } else {
            // we already have a linked list, so we can use its method to append a new edge
            // also we could use here prepend instead of append
            $edges->append($vertexTwo);
        }
    }

    protected function removeConnection($vertexOne, $vertexTwo)
    {
        $edges = $this->graph[$vertexOne];
        $node = $edges->head;

        // if removable node is the first node in the linked list, just reassign head for linked list
        if ($node->getValue() === $vertexTwo) {
            $edges->head = $node->getNext();
        } else {
            // we should iterate through each node (edge) until we find removable
            $nextNode = $node->getNext();
            while ($nextNode) {
                if ($nextNode->getValue() === $vertexTwo) {
                    $node->setNext($nextNode->getNext());
                }
                $node = $nextNode;
                $nextNode = $nextNode->getNext();
            }
        }
    }
}

$myAdjacencyList = new MyAdjacencyList();
$myAdjacencyList->addVertex(0);
$myAdjacencyList->addVertex(1);
$myAdjacencyList->addVertex(2);
$myAdjacencyList->addVertex(3);
$myAdjacencyList->addEdge(0, 1);
$myAdjacencyList->addEdge(0, 2);
$myAdjacencyList->addEdge(0, 3);
$myAdjacencyList->addEdge(1, 2);
$myAdjacencyList->printGraph();
/**
 * Visualization of matrix above:
 *       0 -- 3
 *      / \
 *     1 -- 2
 */

//$myAdjacencyList->removeEdge(0, 3);
//$myAdjacencyList->removeEdge(0, 1);
