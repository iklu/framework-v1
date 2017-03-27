<?php
/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 27.03.2017
 * Time: 11:49
 */

namespace simpleframework\Utils;

/**
 * Class ArrayMethods
 * @package framewok
 */
class ArrayMethods
{

    /**
     * ArrayMethods constructor.
     */
    private function __construct()
    {
        //do nothing
    }


    /**
     * ArrayMethods clone.
     */
    private function __clone()
    {
        //do nothing
    }

    /**
     * The clean() method removes all values considered empty() and returns the resultant array.
     * Iterates over all elements with the callback function
     *
     * @param $array
     * @return mixed
     */
    public static function clean($array){
        return array_filter($array, function($item){
           return !empty($item);
        });
    }

    /**
     *
     * The trim() method returns an array, which contains all the items of the initial array, after they have been trimmed of all whitespace.
     * Iterates over all elements with the callback function
     *
     * @param $array
     * @return mixed
     */
    public static function trim($array)
    {
        return array_map(function($item){
           return trim($item);
        }, $array);
    }
}