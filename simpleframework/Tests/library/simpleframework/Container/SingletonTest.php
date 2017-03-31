<?php
/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 31.03.2017
 * Time: 11:17
 */

namespace simpleframework\Tests\library\simpleframework\Container;


use PHPUnit\Framework\TestCase;
use simpleframework\Container\Singleton as SingletonContainer;
use simpleframework\Container\Singleton;

class SingletonTest extends TestCase
{
    public function testSingletonClass() {
        $singleton = SingletonContainer::instance();
        $this->assertTrue(is_a($singleton, "simpleframework\Container\Singleton"));

        $foo = Singleton::instance();
        $this->assertEquals(FALSE, $foo->counterIsOdd(), '0 is even');
        $foo = Singleton::instance();
        $foo->incrementCounter();
        $this->assertEquals(TRUE, $foo->counterIsOdd(), '1 is uneven');
        $foo->incrementCounter();
    }

    public function testSingleton2Class() {
        $singleton = SingletonContainer::instance();
        $this->assertTrue(is_a($singleton, "simpleframework\Container\Singleton"));
        $foo = Singleton::instance();
    
        $this->assertEquals(FALSE, $foo->counterIsOdd(), $foo->getCounter().' is even');
        $foo->incrementCounter();
        $this->assertEquals(TRUE, $foo->counterIsOdd(), $foo->getCounter().' is uneven');
    }
}