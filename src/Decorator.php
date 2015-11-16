<?php

namespace Edsonlimadev\Collections;

use Edsonlimadev\Collections\Interfaces;
use Edsonlimadev\Collections\Traits\ComparableOperations;
use Edsonlimadev\Collections\Traits\Decorator\CollectionBasicOperations as BasicOperations;
use Edsonlimadev\Collections\Traits\Decorator\CollectionFunctionalOperations as FunctionalOperations;

/**
 * Class Decorator
 * @package Edsonlimadev\Collections
 */
abstract class Decorator implements Interfaces\Collection, Interfaces\Comparable
{
    use BasicOperations;
    use FunctionalOperations;
    use ComparableOperations;

    /**
     * @var Collection
     */
    protected $decorated;

    /**
     * @param Interfaces\Collection $collection
     */
    public function __construct(Interfaces\Collection $collection)
    {
        $this->decorated = $collection;
    }
}
