<?php

namespace Edsonlimadev\Collections\Traits;

use Edsonlimadev\Collections\Interfaces\Collection;

trait ComparableOperations
{
    /**
     * @param $something
     * @return bool
     */
    public function equals($something)
    {
        if (!$something instanceof Collection) {
            return false;
        }

        if (get_class($this) != get_class($something)) {
            return false;
        }

        if (count($this) !== count($something)) {
            return false;
        }

        return empty(array_diff_assoc($this->elements, $something->toArray()));
    }

    /**
     * @param $something
     * @return bool
     */
    public function different($something)
    {
        return !$this->equals($something);
    }
}
