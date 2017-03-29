<?php
namespace simpleframework\tests\library\simpleframework\Utils;
use simpleframework\Utils\StringMethods;
use PHPUnit\Framework\TestCase;


/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 27.03.2017
 * Time: 10:17
 */
class StringMethodsTest extends TestCase
{
    public function testDelimiter() {
        StringMethods::setDelimiter("#");
        $this->assertEquals("#", StringMethods::getDelimiter());
    }

    /**
     * @outputBuffering disabled
     */
    public function testNormalize() {
        $assert = StringMethods::match("hola", "#hola#");
        $this->assertEquals(1, count($assert));

        $assert = StringMethods::match("hola", "#hola#");
        $this->assertNotEmpty($assert);

        $assert = StringMethods::match("hola", "#hoa#");
        $this->assertNull(null, $assert);

    }
}