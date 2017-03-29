<?php
/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 29.03.2017
 * Time: 16:57
 */

namespace simpleframework;


class ArrayClass
{

    private $name;

    public function __construct($name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    public function __set_state($array){
        return $array;
    }
}