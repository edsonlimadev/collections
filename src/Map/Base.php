<?php

namespace Edsonlimadev\Collections\Map;

use Edsonlimadev\Collections\Collection;
use Edsonlimadev\Collections\Exception\KeyNotFoundException;
use Edsonlimadev\Collections\Immutable as ImmutableCollection;
use Edsonlimadev\Collections\Interfaces\OptionalAggregate;

/**
 * Class Map
 * @package Edsonlimadev\Collections
 */
abstract class Base extends Collection implements Interfaces\Map, OptionalAggregate
{
    /**
     * @return Collection
     */
    public function keys()
    {
        return new ImmutableCollection(array_keys($this->elements));
    }

    /**
     * @return Collection
     */
    public function values()
    {
        return new ImmutableCollection(array_values($this->elements));
    }

    /**
     * @param $key
     * @throws KeyNotFoundException
     * @return mixed
     */
    public function get($key)
    {
        if (!isset($this->elements[$key])) {
            throw new KeyNotFoundException(sprintf('Key %s not found', $key));
        }

        return $this->elements[$key];
    }

    /**
     * @param $key
     * @param $default
     * @return mixed
     */
    public function getValue($key, $default)
    {
        if (!empty($this->elements[$key])) {
            return $this->elements[$key];
        }

        return $default;
    }

    /**
     * @param $key
     * @return boolean
     */
    public function has($key)
    {
        return isset($this->elements[$key]);
    }
}
