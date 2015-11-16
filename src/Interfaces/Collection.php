<?php

namespace Edsonlimadev\Collections\Interfaces;

use Edsonlimadev\Collections\Exception;

interface Collection extends \IteratorAggregate, \Countable
{
    /**
     * @return array
     */
    public function toArray();

    /**
     * @param callable $block
     * @throws Exception\InvalidClosureException
     */
    public function each(callable $block);

    /**
     * @param callable $filter
     * @throws Exception\InvalidFilterException
     * @return Collection
     */
    public function filter(callable $filter);

    /**
     * @param callable $map
     * @throws Exception\InvalidMapException
     * @return Collection
     */
    public function map(callable $map);

    /**
     * @param callable $reducer
     * @param null $initialValue
     * @throws Exception\InvalidReduceException
     * @return mixed
     */
    public function reduce(callable $reducer, $initialValue = null);

    /**
     * @param $element
     * @return bool
     */
    public function contains($element);

    /**
     * @param callable $sort
     * @throws Exception\InvalidSortException
     * @return static
     */
    public function sort(callable $sort);
}
