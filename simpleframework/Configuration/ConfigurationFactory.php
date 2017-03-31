<?php
/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 31.03.2017
 * Time: 09:58
 */

namespace simpleframework\Configuration;


use simpleframework\Configuration\Driver\Ini;
use simpleframework\Core\Base;
use simpleframework\Exception\ArgumentException;
use simpleframework\Exception\ImplementationException;

class ConfigurationFactory extends Base
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
        return new ImplementationException("{$method} method not implemented");
    }

    public function initialize(){
        if (!$this->type){
            throw new ArgumentException("Invalid type");
        }
        switch ($this->type) {
            case "ini":
            {
                return new Ini();
                break;
            }
            default:
            {
                throw new ArgumentException("Invalid Type");
                break;
            }
        }
    }
}