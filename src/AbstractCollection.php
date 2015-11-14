<?php
namespace Edsonlimadev\Collections;

/**
 * Class AbstractCollection
 * @package Edsonlimadev\Collections
 */
abstract class AbstractCollection implements \IteratorAggregate, \Countable
{
    /**
     * @var array
     */
    protected $elements;

    /**
     * @param $elements
     */
    public function __construct($elements = [])
    {
        $this->elements = $elements;
    }


    /**
     * @return array
     */
    public function toArray()
    {
        return $this->elements;
    }

    /**
     * @return \Iterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->elements);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->elements);
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
     * @return AbstractCollection
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
     * @return AbstractCollection
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
     * @param callable $reducer
     * @param null $initialValue
     * @throws Exception\InvalidReduceException
     * @return mixed
     */
    public function reduce(callable $reducer, $initialValue = null)
    {
        $this->checkNumberOfParameters(
            $reducer,
            new Exception\InvalidReduceException('A "reduce function" only has two parameters!')
        );

        return array_reduce($this->elements, $reducer, $initialValue);
    }

    /**
     * @param $element
     * @return bool
     */
    public function contains($element)
    {
        return in_array($element, $this->elements);
    }

    /**
     * @param AbstractCollection $collection
     * @return bool
     */
    public function equals(AbstractCollection $collection)
    {
        if (get_class($this) != get_class($collection)) {
            return false;
        }

        if (count($this) !== count($collection)) {
            return false;
        }

        return empty(array_diff_assoc($this->elements, $collection->toArray()));
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

    protected function checkNumberOfParameters(callable $closure, Exception\InvalidClosureException $exception)
    {
        $nArgs = (new \ReflectionFunction($closure))->getNumberOfParameters();
        if ($nArgs > 2) {
            throw $exception;
        }
    }
}
