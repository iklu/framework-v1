<?php
/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 27.03.2017
 * Time: 16:26
 */

namespace simpleframework\Tests\library\simpleframework\Core;


use PHPUnit\Framework\TestCase;
use simpleframework\Hello;

class BaseTest extends TestCase
{
    public function testBaseClass() {
        $hello = new Hello();
        $hello->world = "foo!";
        $this->assertEquals("foo!", $hello->world);
    }
}