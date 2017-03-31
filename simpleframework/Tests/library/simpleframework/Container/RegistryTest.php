<?php
/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 31.03.2017
 * Time: 14:56
 */

namespace simpleframework\Tests\library\simpleframework\Container;


use PHPUnit\Framework\TestCase;
use simpleframework\Container\Registry;
use simpleframework\Hello;

class RegistryTest extends TestCase
{
    public function testRegistryClasses(){
        //register a new instance of the object Hello
        Registry::set("hello", new Hello());

        //get the instance from the container
        $hello = Registry::get("hello");

        $hello->setWorld("MY WORLD");

        $this->assertEquals($hello->getWorld(), "MY WORLD");

    }

}