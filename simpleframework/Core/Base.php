<?php
/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 27.03.2017
 * Time: 15:51
 */

namespace simpleframework\Core;

use simpleframework\Reflection\Inspector;

class Base
{
    /**
     * @var Inspector
     */
    private $_inspector;

    public function __construct($options = array())
    {
        $this->_inspector = new Inspector($this);
    }
}