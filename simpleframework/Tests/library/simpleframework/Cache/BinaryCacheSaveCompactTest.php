<?php

/**
 * Created by PhpStorm.
 * User: ovidiu
 * Date: 27.03.2017
 * Time: 17:57
 */

namespace simpleframework\Tests\library\Cache;

use PHPUnit\Framework\TestCase;
use simpleframework\Cache\Driver\BinaryCache;

class BinaryCacheSaveCompactTest extends TestCase {

	public function testSaveZipped() {
        file_put_contents( './var/cache/default.cache', '' );
        file_put_contents( './var/cache/default.keys', '' );
        file_put_contents( './var/cache/default.gz.cache', '' );
        file_put_contents( './var/cache/default.gz.keys', '' );

        {
            $c = new BinaryCache('default');
            $c->init();

            $c->store( 'a', 'aaa bbb ccc aaa bbb ccc aaa bbb ccc aaa bbb ccc aaa bbb ccc aaa bbb ccc' );
            $c->store( 'b', 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb' );
            $c->store( 'c', 'ccccccccccccccccccccccc aaaaaaaaaaaaaaaaaaaaaaa ccccccccccccccccccccccc' );

            $c->store( 'b', 'BBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBB' );
            $c->erase( 'a' );

            $c->saveCompact();
        }

        {
            $c2 = new BinaryCache('default', true);
            $c2->init();

            $this->assertFalse( $c2->isCached( 'a' ) );
            $this->assertEquals( 'BBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBB', $c2->retrieve( 'b' ) );
            $this->assertEquals( 'ccccccccccccccccccccccc aaaaaaaaaaaaaaaaaaaaaaa ccccccccccccccccccccccc', $c2->retrieve( 'c' ) );
        }
	}
}
