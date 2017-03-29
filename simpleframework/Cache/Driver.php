<?php
/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 27.03.2017
 * Time: 16:55
 */

namespace simpleframework\Cache;


use simpleframework\Core\Base;
use simpleframework\Exception\ImplementationException;

/**
 * Class Driver
 * @package simpleframework\Cache
 */
class Driver extends Base
{
    /**
     * @return $this
     */
    public function initialize()
    {
        return $this;
    }

    /**
     * @param $method
     * @return ImplementationException
     */
    protected function _getExceptionForImplementation($method) : ImplementationException
    {
        return new ImplementationException("{$method} method not implemented");
    }
}