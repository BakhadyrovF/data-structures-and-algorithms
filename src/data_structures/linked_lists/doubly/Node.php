<?php

final class Node
{
    private $value;
    private ?self $previous;
    private ?self $next;

    public function __construct($value, self $previous = null, self $next = null)
    {
        $this->value = $value;
        $this->previous = $previous;
        $this->next = $next;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }

    /**
     * @return Node|null
     */
    public function getPrevious(): ?Node
    {
        return $this->previous;
    }

    /**
     * @param Node|null $previous
     */
    public function setPrevious(?Node $previous): void
    {
        $this->previous = $previous;
    }

    /**
     * @return Node|null
     */
    public function getNext(): ?Node
    {
        return $this->next;
    }

    /**
     * @param Node|null $next
     */
    public function setNext(?Node $next): void
    {
        $this->next = $next;
    }


}