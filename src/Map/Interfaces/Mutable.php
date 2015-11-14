<?php

namespace Edsonlimadev\Collections\Map\Interfaces;

/**
 * Interface Mutable
 * @package Edsonlimadev\Collections\Map\Interfaces
 */
interface Mutable extends Map
{
    /**
     * @param $key
     * @param $vale
     * @return void
     */
    public function set($key, $vale);

    /**
     * @param $key
     * @return void
     */
    public function remove($key);
}
