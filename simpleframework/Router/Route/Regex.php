<?php
/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 31.03.2017
 * Time: 16:20
 */

namespace simpleframework\Router\Route;

use simpleframework\Router\Route;

class Regex extends Route
{
    /**
     * @readwrite
     */
    protected $_keys;

    /**
     * Creates the correct regular expression search string and returns any matches to the provided URL.
     *
     * @param $url
     * @return bool
     */
    public function matches($url)
    {
        $pattern = $this->pattern;

        preg_match_all("#^{$pattern}$#", $url, $values);

        if (sizeof($values) && sizeof($values[0]) && sizeof($values[1])) {
            //values found, modify parameters and return
            $derived = array_combine($this->keys, $values[1]);
            $this->parameters = array_merge($this->parameters, $derived);
            return true;
        }
        return false;
    }
}