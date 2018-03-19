<?php

namespace Framework;

class Container
{
    private $services = [];
    
    public function set($key, $object)
    {
        $this->services[$key] = $object;
        
        return $this;
    }
    
    public function get($key)
    {

        if (!isset($this->services[$key])) {
            throw new \Exception("Service not found");
        }
        
        return $this->services[$key];
    }
}