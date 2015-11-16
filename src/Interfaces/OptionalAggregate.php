<?php

namespace Edsonlimadev\Collections\Interfaces;

/**
 * Interface OptionalAggregate
 * @package Edsonlimadev\Collections\Interfaces
 */
interface OptionalAggregate
{
    /**
     * @param $offset
     * @return boolean
     */
    public function has($offset);

    /**
     * @param $offset
     * @param $defaultValue
     * @return mixed
     */
    public function getValue($offset, $defaultValue);
}
