<?php

namespace Edsonlimadev\Collections\Map\Decorator;

use Edsonlimadev\Collections\Decorator;
use Edsonlimadev\Collections\Exception\KeyNotFoundException;
use Edsonlimadev\Collections\Map\Decorator\Traits\MapBasicOperations;
use Edsonlimadev\Collections\Map\Interfaces;


/**
 * Class ArrayAccess
 * @package Edsonlimadev\Collections\Map\Decorator
 */
class ArrayAccess extends Decorator implements \ArrayAccess, Interfaces\Map
{
    use MapBasicOperations;

    /**
     * @param Interfaces\Map $map
     */
    public function __construct(Interfaces\Map $map)
    {
        $this->decorated = $map;
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        try {
            $this->decorated->get($offset);
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
        return $this->decorated->get($offset);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     * @throws \Exception
     */
    public function offsetSet($offset, $value)
    {
        $map = $this->decorated;
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
        $map = $this->decorated;
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
}
