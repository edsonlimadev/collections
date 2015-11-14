<?php

namespace Edsonlimadev\Collections;

use Edsonlimadev\Collections\Traits\CollectionBasicOperations as BasicOperations;
use Edsonlimadev\Collections\Traits\CollectionFunctionalOperations as FunctionalOperations;

/**
 * Class AbstractCollection
 * @package Edsonlimadev\Collections
 */
abstract class AbstractCollection implements Collection
{
    use BasicOperations;
    use FunctionalOperations;

    /**
     * @param $elements
     */
    public function __construct($elements = [])
    {
        $this->elements = $elements;
    }

    /**
     * @param Collection $collection
     * @return bool
     */
    public function equals(Collection $collection)
    {
        if (get_class($this) != get_class($collection)) {
            return false;
        }

        if (count($this) !== count($collection)) {
            return false;
        }

        return empty(array_diff_assoc($this->elements, $collection->toArray()));
    }
}
