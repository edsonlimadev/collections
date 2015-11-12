<?php

namespace Edsonlimadev\Collections;

/**
 * Class Map
 * @package Edsonlimadev\Collections
 */
class Map extends AbstractCollection
{
    /**
     * @return AbstractCollection
     */
    public function keys()
    {
        return new Immutable(array_keys($this->elements));
    }

    /**
     * @return AbstractCollection
     */
    public function values()
    {
        return new Immutable(array_values($this->elements));
    }
}
