<?php

final class Node
{
    private $value;
    private ?self $next = null;

    public function __construct($value, self $next = null)
    {
        $this->value = $value;
        $this->next = $next;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getNext()
    {
        return $this->next;
    }

    public function setNext(?self $next)
    {
        $this->next = $next;
    }
}
