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

    public function matches($url) {
        $pattern = $this->pattern;

        preg_match_all("#^{$pattern}$#", $url, $values);

        if (sizeof($values) && sizeof($values[0]) && sizeof($values[1]))
        {
            //values found, modify parameters and return
            //TODO
        }


    }


}