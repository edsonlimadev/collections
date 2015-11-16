<?php

namespace Edsonlimadev\Collections\Traits\Decorator;

use Edsonlimadev\Collections\Exception;

trait CollectionFunctionalOperations
{
    /**
     * @param callable $block
     * @throws Exception\InvalidClosureException
     */
    public function each(callable $block)
    {
        $this->decorated->each($block);
    }

    /**
     * @param callable $filter
     * @throws Exception\InvalidFilterException
     * @return \Edsonlimadev\Collections\Interfaces\Collection
     */
    public function filter(callable $filter)
    {
        return $this->decorated->filter($filter);
    }

    /**
     * @param callable $map
     * @throws Exception\InvalidMapException
     * @return \Edsonlimadev\Collections\Interfaces\Collection
     */
    public function map(callable $map)
    {
        return $this->decorated->map($map);
    }

    /**
     * @param callable $reduce
     * @param null $initialValue
     * @throws Exception\InvalidReduceException
     * @return mixed
     */
    public function reduce(callable $reduce, $initialValue = null)
    {
        return $this->decorated->reduce($reduce, $initialValue);
    }

    /**
     * @param callable $sort
     * @throws Exception\InvalidSortException
     * @return static
     */
    public function sort(callable $sort)
    {
        return $this->decorated->sort($sort);
    }
}
