<?php

namespace Edsonlimadev\Collections\Map\Decorator;

use Edsonlimadev\Collections\AbstractCollection;
use Edsonlimadev\Collections\Exception\KeyNotFoundException;
use Edsonlimadev\Collections\Map\Interfaces;
use Edsonlimadev\Collections\Traits\CollectionBasicOperations;
use Edsonlimadev\Collections\Traits\CollectionFunctionalOperations;

/**
 * Class ArrayAccess
 * @package Edsonlimadev\Collections\Map\Decorator
 */
class ArrayAccess extends AbstractCollection implements \ArrayAccess, Interfaces\Map
{
    use CollectionBasicOperations;
    use CollectionFunctionalOperations;

    /**
     * @var Interfaces\Map
     */
    private $map;

    /**
     * @param Interfaces\Map $map
     */
    public function __construct(Interfaces\Map $map)
    {
        $this->map = $map;
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        try {
            $this->map->get($offset);
        } catch (KeyNotFoundException $exception) {
            return false;
        }

        return true;
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->map->get($offset);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     * @throws \Exception
     */
    public function offsetSet($offset, $value)
    {
        $map = $this->map;
        $this->checkIfIsMutable($map, new \Exception);
        $offset = is_null($offset) ? count($map) : $offset;

        $map->set($offset, $value);
    }

    /**
     * @param mixed $offset
     * @throws \Exception
     */
    public function offsetUnset($offset)
    {
        $map = $this->map;
        $this->checkIfIsMutable($map, new \Exception);

        $map->remove($offset);
    }

    /**
     * @param Interfaces\Map $map
     * @param \Exception $exception
     * @throws \Exception
     */
    protected function checkIfIsMutable(Interfaces\Map $map, \Exception $exception)
    {
        if ($map instanceof Interfaces\Immutable) {
            throw $exception;
        }
    }

    /**
     * @return mixed
     */
    public function keys()
    {
        return $this->map->keys();
    }

    /**
     * @return mixed
     */
    public function values()
    {
        return $this->map->values();
    }

    /**
     * @param $key
     * @throws \Edsonlimadev\Collections\Exception\KeyNotFoundException
     * @return mixed
     */
    public function get($key)
    {
        return $this->map->get($key);
    }

    /**
     * @param $method
     * @param $params
     * @return mixed
     */
    public function __call($method, $params)
    {
        return call_user_func_array([$this->map, $method], $params);
    }
}
