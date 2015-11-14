<?php

namespace Edsonlimadev\Collections;

use Edsonlimadev\Collections\Traits\CollectionBasicOperations as BasicOperations;
use Edsonlimadev\Collections\Traits\CollectionFunctionalOperations as FunctionalOperations;

/**
 * Class AbstractCollection
 * @package Edsonlimadev\Collections
 */
abstract class AbstractCollection implements Collection, Comparable
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
     * @param $some
     * @return bool
     */
    public function equals($some)
    {
        if (!$some instanceof Collection) {
            return false;
        }

        if (get_class($this) != get_class($some)) {
            return false;
        }

        if (count($this) !== count($some)) {
            return false;
        }

        return empty(array_diff_assoc($this->elements, $some->toArray()));
    }

    /**
     * @param $some
     * @return bool
     */
    public function different($some)
    {
        return !$this->equals($some);
    }
}
