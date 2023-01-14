<?php


/**
 * Undirected, Unweighted, Acyclic Graph
 */
class MyAdjacencyMatrix
{
    public array $matrix;

    public function __construct(int $size)
    {
        $matrix = [];

        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size; $j++) {
                $matrix[$i][$j][] = 0;
            }
        }

        $this->matrix = $matrix;
    }

    public function addEdge($x, $y)
    {
        $this->matrix[$x][$y] = 1;
        $this->matrix[$y][$x] = 1;

        return true;
    }

    public function removeEdge($x, $y)
    {
        $this->matrix[$x][$y] = 0;
        $this->matrix[$y][$x] = 0;
    }

    public function printMatrix()
    {
        $result = '';
        for ($i = 0; $i < count($this->matrix); $i++) {
            $result .= "vertex ($i) connected to: ";
            for ($j = 0; $j < count($this->matrix); $j++) {
                $result .= $this->matrix[$i][$j] === 1 ? "($j), " : '';
            }
            $result .= PHP_EOL;
        }

        echo $result;
    }
}

$myAdjacencyMatrix = new MyAdjacencyMatrix(4);
$myAdjacencyMatrix->addEdge(0, 1);
$myAdjacencyMatrix->addEdge(0, 2);
$myAdjacencyMatrix->addEdge(0, 3);
$myAdjacencyMatrix->addEdge(1, 2);
$myAdjacencyMatrix->printMatrix();
/**
 * Presentation of matrix above:
 *       0 -- 3
 *      / \
 *     1 -- 2
 */

//$myAdjacencyMatrix->removeEdge(0, 3);
//$myAdjacencyMatrix->printMatrix();