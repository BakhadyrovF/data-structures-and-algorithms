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
                $matrix[$i][] = 0;
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

    public function addVertex()
    {
        // adding a new row for new vertex
        $this->matrix[] = [];

        for ($i = 0; $i < count($this->matrix); $i++) {
            // adding a new column to each row
            $this->matrix[$i][] = 0;
            // adding a new column in each iteration for recently added row (vertex)
            $this->matrix[count($this->matrix) - 1][$i] = 0;
        }
    }

    public function removeVertex($vertex)
    {
        $vertices = [];

        // reindexing all vertices except given to the new array
        for ($i = 0; $i < count($this->matrix); $i++) {
            if ($i !== $vertex) {
                $vertices[] = $this->matrix[$i];
            }
        }

        for ($i = 0; $i < count($vertices); $i++) {
            $edges = [];
            for ($j = 0; $j < count($this->matrix); $j++) {
                if ($j !== $vertex) {
                    $edges[] = $vertices[$i][$j];
                }
            }

            $vertices[$i] = $edges;
        }

        $this->matrix = $vertices;
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
//$myAdjacencyMatrix->printMatrix();
/**
 * Visualization of matrix above:
 *       0 -- 3
 *      / \
 *     1 -- 2
 */


$myAdjacencyMatrix->addVertex();
$myAdjacencyMatrix->removeVertex(4);
print_r($myAdjacencyMatrix->matrix);
//$myAdjacencyMatrix->addEdge(4, 0);
//$myAdjacencyMatrix->addEdge(4, 2);
//$myAdjacencyMatrix->addEdge(4, 3);
//$myAdjacencyMatrix->printMatrix();
