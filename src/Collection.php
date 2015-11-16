<?php

namespace Edsonlimadev\Collections;

use Edsonlimadev\Collections\Interfaces;
use Edsonlimadev\Collections\Traits\CollectionBasicOperations as BasicOperations;
use Edsonlimadev\Collections\Traits\CollectionFunctionalOperations as FunctionalOperations;
use Edsonlimadev\Collections\Traits\ComparableOperations;

/**
 * Class Collection
 * @package Edsonlimadev\Collections
 */
abstract class Collection implements Interfaces\Collection, Interfaces\Comparable
{
    use BasicOperations;
    use FunctionalOperations;
    use ComparableOperations;

    /**
     * @param $elements
     */
    public function __construct($elements = [])
    {
        $this->elements = $elements;
    }
}
