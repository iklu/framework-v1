<?php

namespace simpleframework\Container;

/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 31.03.2017
 * Time: 11:14
 *
 * Instances of non-Singleton classes are given a key (identifier) and are “kept” inside the
 * Registry’s private storage. When requests are made for specific keys, the Registry checks whether there are any
 * instances for those keys, and returns them. If no instance is found at a key, the Registry’s methods will return a default value.
 * Registry accommodates those needs, without requiring us to write a multitude of singletons.
 *
 *
 * Static classes are singletons that have
 * no instance properties/methods or instance accessors/mutators. In fact, the only difference between a static
 * class and our Registry is that no instance of our registry can ever be created. This is fine because we will only need
 * our Registry class in a single context.
 */

/**
 * Class Registry
 * @package simpleframework\Container
 */
class Registry
{
    private static $_instances = array();

    private function __construct()
    {
        // do nothing
    }

    private function __clone()
    {
        // do nothing
    }

    /**
     *
     * The get() method searches the private storage for an instance with a matching key. If it finds an instance, it
     * will return it, or default to the value supplied with the $default parameter.
     *
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    public static function get($key, $default = null)
    {
        if (isset(self::$_instances[$key]))
        {
            return self::$_instances[$key];
        }
        return $default;
    }

    /**
     * The set() method is used to “store” an instance with a specified key in the registry’s private storage.
     *
     * @param $key
     * @param null $instance
     */
    public static function set($key, $instance = null)
    {
        self::$_instances[$key] = $instance;
    }

    /**
     *
     * The erase() method is useful for removing an instance at a certain key.
     *
     * 
     * @param $key
     */
    public static function erase($key)
    {
        unset(self::$_instances[$key]);
    }
}
