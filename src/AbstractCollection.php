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
     * @param $to
     * @return bool
     */
    public function equals($to)
    {
        if (!$to instanceof Collection) {
            return false;
        }

        if (get_class($this) != get_class($to)) {
            return false;
        }

        if (count($this) !== count($to)) {
            return false;
        }

        return empty(array_diff_assoc($this->elements, $to->toArray()));
    }

    /**
     * @param $to
     * @return bool
     */
    public function different($to)
    {
        return !$this->equals($to);
    }
}
