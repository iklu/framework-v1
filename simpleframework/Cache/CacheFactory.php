<?php
/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 27.03.2017
 * Time: 16:43
 */

namespace simpleframework\Cache;

use simpleframework\Cache\Driver\Redis;
use simpleframework\Core\Base;
use simpleframework\Exception\ArgumentException;
use simpleframework\Exception\ImplementationException;

class CacheFactory extends Base
{
    /**
     * @readwrite
     */
    protected $_type;
    /**
     * @readwrite
     */
    protected $_options;

    protected function _getExceptionForImplementation($method)
    {
        throw new ImplementationException("{$method} method not implemented");
    }

    public function initialize() {
        if(!$this->type) {
            throw new ArgumentException("Invalid Type");
        }

        switch ($this->type) {
            case "redis":
            {
                return new Redis($this->options);
                break;
            }
            default:
            {
                throw new ArgumentException("Invalid Type");
            }
        }
    }
}