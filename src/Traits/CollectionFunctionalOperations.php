<?php

namespace Edsonlimadev\Collections\Traits;

use Edsonlimadev\Collections\Exception;

trait CollectionFunctionalOperations
{
    /**
     * @param callable $closure
     * @param Exception\InvalidClosureException $exception
     * @param integer $expected
     */
    protected function checkNumberOfParameters(
        callable $closure,
        Exception\InvalidClosureException $exception,
        $expected = 2
    ) {
        $nArgs = (new \ReflectionFunction($closure))->getNumberOfParameters();

        if ($nArgs > $expected) {
            throw $exception;
        }
    }

    /**
     * @param callable $block
     * @throws Exception\InvalidClosureException
     */
    public function each(callable $block)
    {
        $this->checkNumberOfParameters(
            $block,
            new Exception\InvalidClosureException('An "each block" only has two parameters!')
        );

        array_walk($this->elements, function ($element, $index) use ($block) {
            call_user_func($block, $element, $index);
        });
    }

    /**
     * @param callable $filter
     * @throws Exception\InvalidFilterException
     * @return \Edsonlimadev\Collections\Interfaces\Collection
     */
    public function filter(callable $filter)
    {
        $this->checkNumberOfParameters(
            $filter,
            new Exception\InvalidFilterException('A "filter function" only has two parameters!')
        );

        $filtered = [];

        foreach ($this->elements as $index => $element) {
            if (call_user_func($filter, $element, $index)) {
                $filtered[$index] = $element;
            }
        }

        return new static($filtered);
    }

    /**
     * @param callable $map
     * @throws Exception\InvalidMapException
     * @return \Edsonlimadev\Collections\Interfaces\Collection
     */
    public function map(callable $map)
    {
        $this->checkNumberOfParameters(
            $map,
            new Exception\InvalidMapException('A "filter function" only has two parameters!')
        );
        $keys = array_keys($this->elements);

        return new static(
            array_combine(
                $keys,
                array_map($map, array_values($this->elements), $keys)
            )
        );
    }

    /**
     * @param callable $reduce
     * @param null $initialValue
     * @throws Exception\InvalidReduceException
     * @return mixed
     */
    public function reduce(callable $reduce, $initialValue = null)
    {
        $this->checkNumberOfParameters(
            $reduce,
            new Exception\InvalidReduceException('A "reduce function" only has two parameters!')
        );

        return array_reduce($this->elements, $reduce, $initialValue);
    }

    /**
     * @param callable $sort
     * @throws Exception\InvalidSortException
     * @return static
     */
    public function sort(callable $sort)
    {
        $this->checkNumberOfParameters(
            $sort,
            new Exception\InvalidSortException('A "sort function" only has two parameters!')
        );

        $copy = array_merge($this->elements);
        usort($copy, $sort);
        return new static($copy);
    }
}
