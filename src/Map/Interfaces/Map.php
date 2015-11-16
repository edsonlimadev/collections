<?php

namespace Edsonlimadev\Collections\Map\Interfaces;

use Edsonlimadev\Collections\Interfaces\Collection;

/**
 * Interface Map
 * @package Edsonlimadev\Collections\Map\Interfaces
 */
interface Map extends Collection
{
    /**
     * @return mixed
     */
    public function keys();

    /**
     * @return mixed
     */
    public function values();

    /**
     * @param $key
     * @throws \Edsonlimadev\Collections\Exception\KeyNotFoundException
     * @return mixed
     */
    public function get($key);
}
