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
     * @throwsMessage
     */
    public function each(callable $block)
    {
        $nArgs = (new \ReflectionFunction($block))->getNumberOfParameters();
        if ($nArgs > 2) {
            throw new Exception\InvalidClosureException('An "each block" only has two parameters!');
        }

        array_walk($this->elements, function($element, $index) use ($block) {
            call_user_func($block, $element, $index);
        });
    }

    /**
     * @param callable $filter
     * @throws Exception\InvalidClosureException
     * @return AbstractCollection
     */
    public function filter(callable $filter)
    {
        $nArgs = (new \ReflectionFunction($filter))->getNumberOfParameters();
        if ($nArgs > 2) {
            throw new Exception\InvalidFilterException('A "filter function" only has two parameters!');
        }

        $filtered = [];

        foreach ($this->elements as $index => $element) {
            if (call_user_func($filter, $element, $index)) {
                $filtered[$index] = $element;
            }
        }

        return new static($filtered);
    }

    /**
     * @param callable $mapper
     * @return AbstractCollection
     */
    public function map(callable $mapper)
    {
        $keys = array_keys($this->elements);

        return new static(
            array_combine(
                $keys,
                array_map($mapper, array_values($this->elements), $keys)
            )
        );
    }

    /**
     * @param callable $reducer
     * @param null $initialValue
     * @return mixed
     */
    public function reduce(callable $reducer, $initialValue = null)
    {
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
     * @param callable $sortManager
     * @return static
     */
    public function sort(callable $sortManager)
    {
        $copy = array_merge($this->elements);
        usort($copy, $sortManager);
        return new static($copy);
    }
}
