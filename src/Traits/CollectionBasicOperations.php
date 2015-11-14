<?php

namespace Edsonlimadev\Collections\Traits;

use Edsonlimadev\Collections\Exception;

/**
 * Class CollectionBasicOperations
 * @package Edsonlimadev\Collections\Traits
 */
trait CollectionBasicOperations
{
    /**
     * @var
     */
    protected $elements;

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->elements;
    }

    /**
     * @return \Iterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->elements);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->elements);
    }

    /**
     * @param $element
     * @return bool
     */
    public function contains($element)
    {
        return in_array($element, $this->elements);
    }
}
