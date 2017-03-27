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
use simpleframework\Hello;

class CacheTest extends TestCase
{
    public function testCache() {
        $cache = new CacheFactory(array(
                "type" => "redis"
        ));
        $redis = $cache->initialize()->connect();
        $redis->set("name", "ov");

        $hello = new Hello();
        $data = array_fill(0, 1000000, "hi");

        $hello->cache_set("my_key", $data);
        $redis->set("my_key", $data);

        $t = microtime(true);
        $data = $hello->cache_get("my_key");
        echo "\n ". microtime(true) - $t;

        echo "\n";

        // 0.00013017654418945

        $t = microtime(true);
        $data = $redis->get("my_key");
        echo microtime(true) - $t;
        // 0.061056137084961

        $this->assertEquals($redis->get("name"), "ov");
    }
}