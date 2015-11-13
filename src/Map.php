<?php

namespace Edsonlimadev\Collections;

/**
 * Class Map
 * @package Edsonlimadev\Collections
 */
class Map extends AbstractCollection
{
    /**
     * @return AbstractCollection
     */
    public function keys()
    {
        return new Immutable(array_keys($this->elements));
    }

    /**
     * @return AbstractCollection
     */
    public function values()
    {
        return new Immutable(array_values($this->elements));
    }

    /**
     * @param $key
     * @param mixed $defaultValue
     * @return mixed
     */
    public function get($key, $defaultValue = null)
    {
        return isset($this->elements[$key]) ? $this->elements[$key] : $defaultValue;
    }

    /**
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        $this->elements[$key] = $value;
    }
}
