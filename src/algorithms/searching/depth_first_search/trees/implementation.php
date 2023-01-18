<?php


// import Binary Search Tree
require_once __DIR__ . '/../../../../data_structures/trees/binary_search_tree/implementation.php';

class MyDepthFirstSearch
{
    private array $result = [];
    public function inorder(?Node $node)
    {
        if ($node === null) {
            return;
        }

        $this->inorder($node->getLeft());
        $this->result[] = $node->getValue();
        $this->inorder($node->getRight());

        return $this->result;
    }

    public function preorder(?Node $node)
    {
        if ($node === null) {
            return;
        }

        $this->result[] = $node->getValue();
        $this->preorder($node->getLeft());
        $this->preorder($node->getRight());

        return $this->result;
    }

    public function postorder(?Node $node)
    {
        if ($node === null) {
            return;
        }

        $this->postorder($node->getLeft());
        $this->postorder($node->getRight());
        $this->result[] = $node->getValue();

        return $this->result;
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

$dfs = new MyDepthFirstSearch();
//print_r($dfs->inorder($bst->root)); // [9, 18, 21, 27, 33, 40]
//print_r($dfs->preorder($bst->root)); // [27, 18, 9, 21, 33, 40]
//print_r($dfs->postorder($bst->root)); // [9, 21, 18, 40, 33, 27]
