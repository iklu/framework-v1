<?php
/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 27.03.2017
 * Time: 15:51
 */

namespace simpleframework\Core;

use PHPUnit\Runner\Exception;
use simpleframework\Exception\ArgumentException;
use simpleframework\Exception\PropertyException;
use simpleframework\Exception\ReadOnlyException;
use simpleframework\Exception\WriteOnlyException;
use simpleframework\Reflection\Inspector;
use simpleframework\Utils\StringMethods;

/**
 * Private properties and methods cannot be shared even by subclasses, so I like to keep things protected
 * whenever possible. In the case of the $_inspector property, we declare it private because we will only ever
 * use it for the __call() method in our Base class and we don’t want to add $_inspector to the class scope
 * for subclasses, since every other class in our framework will inherit from it.
 *
 * Class Base
 * @package simpleframework\Core
 */
class Base
{
    /**
     * @var Inspector
     */
    private $_inspector;

    /**
     * Base constructor.
     * @param array $options
     */
    public function __construct($options = array())
    {
        $this->_inspector = new Inspector($this);
        if (is_array($options) || is_object($options))
        {
            foreach ($options as $key => $value)
            {
                $key = ucfirst($key);
                $method = "set{$key}";
                $this->$method($value);
            }
        }
    }

    /**
     * There are three basic parts to our __call() method: checking to see that the inspector is set, handling the
     * getProperty() methods, and handling the setProperty() methods. Here, we begin to make a few assumptions
     * about the general structure of the classes, which will inherit from the Base class.
     *
     * @param $name
     * @param $arguments
     * @return $this|null
     * @throws ArgumentException
     * @throws ReadOnlyException
     * @throws WriteOnlyException
     */
    public function __call($name, $arguments)
    {
        if (empty($this->_inspector)) {
            throw new Exception("Call parent::__construct!");
        }

        $getMatches = StringMethods::match($name, "^get([a-zA-Z0-9]+)$");

        if (sizeof($getMatches) > 0) {
            $normalized = lcfirst($getMatches[0]);
            $property = "_{$normalized}";
            if (property_exists($this, $property))
            {
                $meta = $this->_inspector->getPropertyMeta($property);
                if (empty($meta["@readwrite"]) && empty($meta["@read"]))
                {
                    throw $this->_getExceptionForWriteOnly($normalized);
                }
                if (isset($this->$property))
                {
                    return $this->$property;
                }
                return null;
            }
        }

        $setMatches = StringMethods::match($name, "^set([a-zA-Z0-9]+)$");

        if (sizeof($setMatches) > 0)
        {
            $normalized = lcfirst($setMatches[0]);
            $property = "_{$normalized}";
            if (property_exists($this, $property))
            {
                $meta = $this->_inspector->getPropertyMeta($property);
                if (empty($meta["@readwrite"]) && empty($meta["@write"]))
                {
                    throw $this->_getExceptionForReadOnly($normalized);
                }
                $this->$property = $arguments[0];
                return $this;
            }
        }
        throw $this->_getExceptionForImplementation($name);
    }

    /**
     * The __get() method accepts an argument that represents the name of the property being set
     *
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        $function = "get".ucfirst($name);
        return $this->$function();
    }

    /**
     * The __set() method works similarly, except that it accepts a second argument, which defines the value to be set
     *
     * @param $name
     * @param $value
     * @return mixed
     */
    public function __set($name, $value)
    {
        $function = "set".ucfirst($name);
        return $this->$function($value);
    }

    protected function _getExceptionForReadOnly($property)
    {
        return new ReadOnlyException("{$property} is read-only");
    }
    protected function _getExceptionForWriteOnly($property)
    {
        return new WriteOnlyException("{$property} is write-only");
    }
    protected function _getExceptionForProperty()
    {
        return new PropertyException("Invalid property");
    }
    protected function _getExceptionForImplementation($method)
    {
        return new ArgumentException("{$method} method not implemented");
    }
}