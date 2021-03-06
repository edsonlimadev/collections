<?php

namespace Edsonlimadev\Collections\Interfaces;

/**
 * Interface Comparable
 * @package Edsonlimadev\Collections
 */
interface Comparable
{
    /**
     * @param mixed $something
     * @return boolean
     */
    public function equals($something);

    /**
     * @param mixed $something
     * @return boolean
     */
    public function different($something);
}
