<?php

namespace Edsonlimadev\Collections\Map;

use Edsonlimadev\Collections\AbstractCollection;
use Edsonlimadev\Collections\Exception\KeyNotFoundException;
use Edsonlimadev\Collections\Immutable as ImmutableCollection;

/**
 * Class Map
 * @package Edsonlimadev\Collections
 */
abstract class Base extends AbstractCollection
{
    /**
     * @return AbstractCollection
     */
    public function keys()
    {
        return new ImmutableCollection(array_keys($this->elements));
    }

    /**
     * @return AbstractCollection
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

    public function getValue($key, $default)
    {
        if (!empty($this->elements[$key])) {
            return $this->elements[$key];
        }

        return $default;
    }
}
