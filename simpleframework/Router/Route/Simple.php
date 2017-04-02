<?php
/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 02-Apr-17
 * Time: 17:32
 */

namespace simpleframework\Router\Route;


use simpleframework\Utils\ArrayMethods;

class Simple
{
    /**
     * Converts substrings matching the format of ":property" to regular expression wildcards.
     * The matches properties are stored in $_parameters array.
     *
     * @param $url
     * @return bool|int
     */
    public function matches($url)
    {
        $pattern = $this->pattern;

        //get keys
        preg_match_all("#:([a-zA-Z0-9]+)#", $pattern, $keys);
        if(sizeof($keys) && sizeof($keys[0] && sizeof($keys[1]))) {
            $keys = $keys[1];
        } else {
            //no keys in the pattern, return a simple match
            return preg_match("#^{$pattern}#", $url);
        }

        // normalize route pattern
        $pattern = preg_replace("#:[a-zA-Z0-9]+#", "([a-zA-Z0-9-_]+)", $pattern);

        //check values
        preg_match_all("#^{$pattern}#", $url, $values);

        if (sizeof($values) && sizeof($values[0]) && sizeof($values[1])) {
            //unset the matched url
            unset($values[0]);

            $derived  = array_combine($keys, ArrayMethods::flatten($values));
            $this->parameters = array_merge($this->parameters, $derived);

            return true;
        }
        return false;
    }
}