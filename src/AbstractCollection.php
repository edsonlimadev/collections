<?php

namespace Edsonlimadev\Collections;

use Edsonlimadev\Collections\Interfaces\Collection;
use Edsonlimadev\Collections\Interfaces\Comparable;
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
     * @param $something
     * @return bool
     */
    public function equals($something)
    {
        if (!$something instanceof Collection) {
            return false;
        }

        if (get_class($this) != get_class($something)) {
            return false;
        }

        if (count($this) !== count($something)) {
            return false;
        }

        return empty(array_diff_assoc($this->elements, $something->toArray()));
    }

    /**
     * @param $something
     * @return bool
     */
    public function different($something)
    {
        return !$this->equals($something);
    }
}
