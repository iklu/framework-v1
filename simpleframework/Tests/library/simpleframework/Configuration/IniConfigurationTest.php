<?php

namespace simpleframework\Tests\library\Configuration;
use PHPUnit\Framework\TestCase;
use simpleframework\Configuration\ConfigurationFactory;

/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 31.03.2017
 * Time: 10:10
 */
class IniConfigurationTest extends TestCase
{
    public function testIniConfiguration(){
        $configuration  = new ConfigurationFactory(array("type"=>"ini"));
        $init = $configuration->initialize();
        $this->assertNotNull($init);
        $parsed = $init->parse("config/prod");
        $this->assertNotEmpty($parsed);
    }
}