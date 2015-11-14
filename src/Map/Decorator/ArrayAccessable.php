<?php

namespace Edsonlimadev\Collections\Map\Decorator;

use Edsonlimadev\Collections\Exception\KeyNotFoundException;
use Edsonlimadev\Collections\Map\Base as Map;
use Edsonlimadev\Collections\Map\Interfaces;

/**
 * Class ArrayAccessable
 * @package Edsonlimadev\Collections\Map\Decorator
 */
class ArrayAccessable extends Map implements \ArrayAccess
{
    /**
     * @var Map
     */
    private $map;

    /**
     * @param Map $map
     */
    public function __construct(Map $map)
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
     * @param Map $map
     * @param \Exception $exception
     * @throws \Exception
     */
    protected function checkIfIsMutable(Map $map, \Exception $exception)
    {
        if ($map instanceof Interfaces\Immutable) {
            throw $exception;
        }
    }

    /**
     * @param $method
     * @param $params
     */
    public function __call($method, $params)
    {
        call_user_func_array([$this->map, $method], $params);
    }
}
