<?php

namespace Edsonlimadev\Collections;

use Edsonlimadev\Collections\Interfaces\Collection;
use Edsonlimadev\Collections\Interfaces\Comparable;
use Edsonlimadev\Collections\Traits\CollectionBasicOperations as BasicOperations;
use Edsonlimadev\Collections\Traits\CollectionFunctionalOperations as FunctionalOperations;
use Edsonlimadev\Collections\Traits\ComparableOperations;

/**
 * Class AbstractCollection
 * @package Edsonlimadev\Collections
 */
abstract class AbstractCollection implements Collection, Comparable
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
