<?php
/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 27.03.2017
 * Time: 12:49
 */

namespace simpleframework\Reflection;
use simpleframework\Utils\ArrayMethods;
use simpleframework\Utils\StringMethods;

/**
 * The first few methods of our Inspector class use built-in PHP reflection classes to get the string values of
 * Doc Comments, and to get a list of the properties and methods of a class. If we only wanted the string values,
 * we could make the _getClassComment(), _getPropertyComment(), and _getMethodComment() methods public.
 *
 * Class Inspector
 * @package framework
 */
class Inspector
{
    /**
     * @var
     */
    protected $_class;
    /**
     * @var
     */
    protected $_properties;
    /**
     * @var
     */
    protected $_methods;

    /**
     * @var array
     */
    protected $_meta = array(
        "class" => array(),
        "properties" => array(),
        "methods" => array()
    );

    /**
     * Inspector constructor.
     * @param $class
     */
    public function __construct($class)
    {
        $this->_class = $class;
    }

    /**
     * @return string
     */
    protected function _getClassComment()
    {
        $reflection = new \ReflectionClass($this->_class);
        return $reflection->getDocComment();
    }

    /**
     * @param $property
     * @return string
     */
    protected function _getPropertyComment($property)
    {
        $reflection = new \ReflectionProperty($this->_class, $property);
        return $reflection->getDocComment();
    }

    /**
     * @param $method
     * @return string
     */
    
    protected function _getMethodComment($method)
    {
        $reflection = new \ReflectionMethod($this->_class, $method);
        return $reflection->getDocComment();
    }

    /**
     * @return \ReflectionProperty[]
     */
    protected function _getClassProperties()
    {
        $reflection = new \ReflectionClass($this->_class);
        return $reflection->getProperties();
    }

    /**
     * @return \ReflectionMethod[]
     */
    protected function _getClassMethods()
    {
        $reflection = new \ReflectionClass($this->_class);
        return $reflection->getMethods();
    }

    /**
     * The internal _parse() method uses a fairly simple regular expression to match key/value pairs
     * within the Doc Comment string returned by any of our _get...Meta() methods. It does this using the
     * StringMethods::match() method. It loops through all the matches, splitting them by key/value. If it finds no
     * value component, it sets the key to a value of true. This is useful for flag keys such as @readwrite or @once. If it
     * finds a value component, it splits the value by, and assigns an array of value parts to the key. Finally, it returns
     * the key/value(s) associative array.
     *
     * @param $comment
     * @return array
     */
    protected function _parse($comment)
    {
        $meta = [];
        $pattern = "((@[a-zA-Z]+\s*[a-zA-Z0-9, ()_]*))";
        $matches = StringMethods::match($comment, $pattern);
         if ($matches != null) {
             foreach ($matches as $match) {
                 $parts = ArrayMethods::clean(ArrayMethods::trim(StringMethods::split($match, "[\s]", 2)));
                 $meta[$parts[0]] = true;
                 if (sizeof($parts) > 1) {
                     $meta[$parts[0]] = ArrayMethods::clean(ArrayMethods::trim(StringMethods::split($parts[1], ",")));
                 }
             }
         }
        return $meta;
    }

    /**
     * Get the class meta
     *
     * @return mixed
     */
    public function getClassMeta()
    {
        if (!isset($this->_meta["class"])) {
            $comment = $this->_getClassComment();

            if (!empty($comment))
            {
                $this->_meta["class"] = $this->_parse($comment);
            }
            else
            {
                $this->_meta["class"] = null;
            }
        }

        return $this->_meta["class"];
    }

    /**
     * Get the class properties
     *
     * @return \ReflectionProperty[]
     */
    public function getClassProperties()
    {
        if (!isset($this->_properties))
        {
            $this->_properties = $this->_getClassProperties();
            foreach ($this->_properties as $property)
            {
                $this->_properties[] = $property->getName();
            }
        }
        return $this->_properties;
    }

    /**
     * Get the class methods
     *
     * @return \ReflectionMethod[]
     */
    public function getClassMethods()
    {
        if (!isset($this->_methods))
        {
            $this->_methods = $this->_getClassMethods();
            foreach ($this->_methods as $method)
            {
                $this->_methods[] = $method->getName();
            }
        }
        return $this->_methods;
    }

    /**
     * Get property meta
     *
     * @param $property
     * @return mixed
     */
    public function getPropertyMeta($property)
    {
        if (!isset($this->_meta["properties"][$property]))
        {
            $comment = $this->_getPropertyComment($property);
            if (!empty($comment))
            {
                $this->_meta["properties"][$property] = $this->_parse($comment);
            }
            else
            {
                $this->_meta["properties"][$property] = null;
            }
        }
        return $this->_meta["properties"][$property];
    }

    /**
     * Get method meta
     *
     * @param $method
     * @return mixed
     */
    public function getMethodMeta($method)
    {
        if (!isset($this->_meta["methods"][$method]))
        {
            $comment = $this->_getMethodComment($method);
            if (!empty($comment))
            {
                $this->_meta["methods"][$method] = $this->_parse($comment);
            }
            else
            {
                $this->_meta["methods"][$method] = null;
            }
        }
        return $this->_meta["methods"][$method];
    }
}