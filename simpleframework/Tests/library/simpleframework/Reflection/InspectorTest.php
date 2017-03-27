<?php
/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 27.03.2017
 * Time: 12:54
 */

namespace simpleframework\tests\library\simpleframework\Reflection;

use PHPUnit\Framework\TestCase;
use simpleframework\Reflection\Inspector;
use simpleframework\Utils\StringMethods;

class InspectorTest extends TestCase
{

    public function testGetClassMeta() {
        $inspector = new Inspector(StringMethods::class);
        $classMeta = $inspector->getClassMethods();
        $this->assertNotEmpty($classMeta);
    }

    public function testGetClassProperties() {
        $inspector = new Inspector(StringMethods::class);
        $classProperties = $inspector->getClassProperties();
        $this->assertNotEmpty($classProperties);
    }

    public function testGetClassMethods() {
        $inspector = new Inspector(StringMethods::class);
        $classMethods = $inspector->getClassMethods();
        $this->assertNotEmpty($classMethods);
    }

    public function testGetPropertyMeta(){
        $inspector = new Inspector(StringMethods::class);
        $propertyMeta = $inspector->getPropertyMeta("_delimiter");
        $this->assertNotEmpty($propertyMeta);
    }

    public function testGetMethodMeta() {
        $inspector = new Inspector(StringMethods::class);
        $methodMeta = $inspector->getMethodMeta("match");
        $this->assertNotEmpty($methodMeta);
    }
}