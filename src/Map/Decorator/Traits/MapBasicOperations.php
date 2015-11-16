<?php

namespace Edsonlimadev\Collections\Map\Decorator\Traits;

trait MapBasicOperations
{
    /**
     * @return mixed
     */
    public function keys()
    {
        return $this->decorated->keys();
    }
    
    /**
     * @return mixed
     */
    public function values()
    {
        return $this->decorated->values();
    }

    /**
     * @param $key
     * @throws \Edsonlimadev\Collections\Exception\KeyNotFoundException
     * @return mixed
     */
    public function get($key)
    {
        return $this->decorated->get($key);
    }
    
    /**
     * @param $method
     * @param $params
     * @return mixed
     */
    public function __call($method, $params)
    {
        return call_user_func_array([$this->decorated, $method], $params);
    }
}