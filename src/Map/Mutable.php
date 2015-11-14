<?php

namespace Edsonlimadev\Collections\Map;

use Edsonlimadev\Collections;

/**
 * Class Mutable
 * @package Edsonlimadev\Collections\Map
 */
class Mutable extends Base implements Interfaces\Mutable
{
    /**
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        $this->elements[$key] = $value;
    }

    /**
     * @param $key
     */
    public function remove($key)
    {
        unset($this->elements[$key]);
    }
}
