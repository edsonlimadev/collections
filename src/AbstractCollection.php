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
     */
    public function each(\Closure $block)
    {
        foreach ($this->elements as $index => $element) {
            $block($element, $index);
        }
    }

    /**
     * @param callable $filter
     * @return AbstractCollection
     */
    public function filter(\Closure $filter)
    {
        return new static(array_filter($this->elements, $filter));
    }

    /**
     * @param callable $mapper
     * @return AbstractCollection
     */
    public function map(\Closure $mapper)
    {
        return new static(array_map($mapper, $this->elements));
    }

    /**
     * @param callable $reducer
     * @param null $initialValue
     * @return mixed
     */
    public function reduce(\Closure $reducer, $initialValue = null)
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
    public function sort(\Closure $sortManager)
    {
        $copy = array_merge($this->elements);
        usort($copy, $sortManager);
        return new static($copy);
    }
}
