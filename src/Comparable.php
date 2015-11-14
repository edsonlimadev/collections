<?php

namespace Edsonlimadev\Collections;

/**
 * Interface Comparable
 * @package Edsonlimadev\Collections
 */
interface Comparable
{
    /**
     * @param $to
     * @return boolean
     */
    public function equals($to);

    /**
     * @param $to
     * @return boolean
     */
    public function different($to);
}