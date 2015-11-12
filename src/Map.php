<?php

namespace Edsonlimadev\Collections;

/**
 * Class Map
 * @package Edsonlimadev\Collections
 */
class Map extends AbstractCollection
{
    /**
     * @return Immutable
     */
    public function keys()
    {
        return new Immutable(array_keys($this->elements));
    }
}
