<?php

namespace simpleframework;

use simpleframework\Core\Base;

class Hello extends Base
{
    /**
     * @readwrite
     * @var
     */
    protected $_world;
    public function setWorld($value)
    {
        echo "your setter is being called!";
        $this->_world = $value;
    }
    public function getWorld()
    {
        echo "your getter is being called!";
        return $this->_world;
    }
}