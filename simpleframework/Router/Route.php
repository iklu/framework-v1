<?php
/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 31.03.2017
 * Time: 16:18
 */

namespace simpleframework\Router;

use simpleframework\Core\Base;
use simpleframework\Exception\ImplementationException;

class Route extends Base
{
    /**
     * @readwrite
     */
    protected $_pattern;

    /**
     * @readwrite
     */
    protected $_controller;

    /**
     * @readwrite
     */
    protected $_action;

    /**
     * @readwrite
     */
    protected $_parameters = array();

    public function _getExceptionForImplementation($method)
    {
        return new ImplementationException("{$method} method not implemented");
    }
}