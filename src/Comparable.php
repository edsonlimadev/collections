<?php

namespace Edsonlimadev\Collections;

/**
 * Interface Comparable
 * @package Edsonlimadev\Collections
 */
interface Comparable
{
    /**
     * @param mixed $some
     * @return boolean
     */
    public function equals($some);

    /**
     * @param mixed $some
     * @return boolean
     */
    public function different($some);
}
