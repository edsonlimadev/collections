<?php

namespace Edsonlimadev\Collections;

use Edsonlimadev\Collections\Interfaces\Collection;
use Edsonlimadev\Collections\Interfaces\Comparable;
use Edsonlimadev\Collections\Traits\ComparableOperations;
use Edsonlimadev\Collections\Traits\Decorator\CollectionBasicOperations as BasicOperations;
use Edsonlimadev\Collections\Traits\Decorator\CollectionFunctionalOperations as FunctionalOperations;

/**
 * Class AbstractDecorator
 * @package Edsonlimadev\Collections
 */
abstract class AbstractDecorator implements Collection, Comparable
{
    use BasicOperations;
    use FunctionalOperations;
    use ComparableOperations;

    /**
     * @var Collection
     */
    protected $decorated;
}
