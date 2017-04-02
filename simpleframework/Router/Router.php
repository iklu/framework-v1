<?php
/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 02-Apr-17
 * Time: 17:51
 */

namespace simpleframework\Router;


use simpleframework\Core\Base;

/**
 * Will use the requested URL, as well as the controller/action metadata, to determine the correct controller/action to execute.
 * It needs to handle multiple defined routes if no defined routes are matched
 *
 * Class Router
 * @package simpleframework\Router
 */
class Router extends Base
{
    /**
     * @var
     * @readwrite
     */
    protected $_url;

    /**
     * @var
     * @readwrite
     */
    protected $_extension;

    /**
     * @var
     * @read
     */
    protected $_controller;

    /**
     * @var
     * @read
     */
    protected $_action;

    /**
     * @var array
     */
    protected $_routes = [];

    public function _getExceptionForImplementation($method)
    {
        return parent::_getExceptionForImplementation($method);
    }

    public function addRoute($route){
        $this->_routes[] = $route;
        return $this;
    }

    public function removeRoute($route){
        foreach ($this->_routes as $i=>$stored) {
            if ($stored == $route){
                unset($this->_routes[$i]);
            }
        }
    }

}