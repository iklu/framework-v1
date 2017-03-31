<?php
/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 27.03.2017
 * Time: 17:57
 */

namespace simpleframework\Tests\library\Cache;


use PHPUnit\Framework\TestCase;
use simpleframework\Cache\CacheFactory;

class RedisCacheTest extends TestCase
{
    public function testCache() {
        $cache = new CacheFactory(array(
                "type" => "redis"
        ));

        $redis = $cache->initialize()->connect();
        $redis->set("name", "ov");

        $this->assertEquals($redis->get("name"), "ov");
    }
}