<?php

namespace Edsonlimadev\Collections\Traits\Decorator;

use Edsonlimadev\Collections\Exception;

/**
 * Class CollectionBasicOperations
 * @package Edsonlimadev\Collections\Traits
 */
trait CollectionBasicOperations
{
    /**
     * @return array
     */
    public function toArray()
    {
        return $this->decorated->toArray();
    }

    /**
     * @return \Iterator
     */
    public function getIterator()
    {
        return $this->decorated->getIterator();
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->decorated);
    }

    /**
     * @param $element
     * @return bool
     */
    public function contains($element)
    {
        return $this->decorated->contains($element);
    }
}
