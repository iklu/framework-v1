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
use simpleframework\Cache\Driver\BinaryCache;

class RedisCacheTest extends TestCase
{
    public function testCache() {
        $inspector = new BinaryCache();
        $inspector->init();
        $d = $inspector->retrieve("08ae514ff063ceacea80366d5553e553eac0b893"); // 08ae514ff063ceacea80366d5553e553eac0b893

        var_dump($d);








        $cache = new CacheFactory(array(
                "type" => "redis"
        ));
        $redis = $cache->initialize()->connect();
        $redis->set("name", "ov");
        $this->assertEquals($redis->get("name"), "ov");
    }
}