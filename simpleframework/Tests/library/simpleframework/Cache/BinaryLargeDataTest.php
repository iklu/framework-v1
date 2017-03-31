<?php

/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 27.03.2017
 * Time: 17:57
 */

namespace simpleframework\Tests\library\Cache;

use PHPUnit\Framework\TestCase;
use simpleframework\ArrayClass;
use simpleframework\Cache\Driver\BinaryCache;


class BinaryLargeDataTest extends TestCase
{
    public function testLargeObjectData(){
        ini_set('memory_limit','4000M');
//        file_put_contents( './var/cache/default.cache', '' );
//        file_put_contents( './var/cache/default.keys', '' );

        $dataFromCache = [];
        $data = [];

        $cache = new BinaryCache();
        $cache->init();

        if(!$cache->isCached("names")) {
            $generate = array_fill(0, 1000000, str_shuffle("ovidiusdfsdf"));
            foreach($generate as $value) {
                $data[] = new ArrayClass($value);
            }
            $cache->store("names", $data);
            print "Save to cache";
        } else {
            $starttime = microtime(true);
            $dataFromCache = $cache->retrieve("names");
            $difftime = microtime(true)-$starttime;
            print "\nFrom Cache :".$difftime. " seconds";
        }


        $this->assertEquals(count($dataFromCache), 1000000);

    }
}