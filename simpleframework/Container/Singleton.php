<?php
/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 31.03.2017
 * Time: 11:15
 */

namespace simpleframework\Container;


class Singleton
{
    private $counter = 0;

    private static $_instance;

    private function __construct()
    {
        // do nothing
    }

    private function __clone()
    {
        // do nothing
    }

    public static function instance()
    {
        if (!isset(self::$_instance))
        {
            echo "INSTANCE1\n";
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function getCounter()
    {
        return $this->counter;
    }

    public function incrementCounter()
    {
        $this->counter++;
    }

    public function counterIsOdd()
    {
        return $this->counter % 2 == 0 ? FALSE : TRUE;
    }


}