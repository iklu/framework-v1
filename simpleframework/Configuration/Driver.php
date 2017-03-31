<?php
/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 31.03.2017
 * Time: 10:21
 */

namespace simpleframework\Configuration;


use simpleframework\Core\Base;
use simpleframework\Exception\ImplementationException;

/**
 * Because our factory allows many different kinds of configuration driver classes to be used, we need a way
 * to share code across all driver classes. We achieve this by making our driver classes inherit from this base driver class
 *
 * Class Driver
 * @package simpleframework\Configuration
 */
class Driver extends Base
{
    protected $_parsed = array();
    public function initialize()
    {
        return $this;
    }
    protected function _getExceptionForImplementation($method)
    {
        return new ImplementationException("{$method} method not implemented");
    }
}