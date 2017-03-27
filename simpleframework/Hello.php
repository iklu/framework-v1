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

     public function cache_set($key, $val) {
        $val = var_export($val, true);
        $val = str_replace('stdClass::__set_state', '(object)', $val);
        $tmp = "./tmp/$key." . uniqid('', true) . '.tmp';

        file_put_contents($tmp, '<?php $val = ' . $val . ';', LOCK_EX);

        rename($tmp, "./tmp/$key");
    }

    public function cache_get($key) {
        @include "./tmp/$key";
        return isset($val) ? $val : false;
    }
}