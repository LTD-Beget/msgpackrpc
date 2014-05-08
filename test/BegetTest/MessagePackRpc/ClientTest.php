<?php
/**
 *
 * LICENCE
 *
 * This file is subject to the terms and conditions defined in
 * file 'LICENSE.txt', which is part of this source code package.
 *
 * @author Schwartz Michaël
 * @copyright Copyright (c) EPOKMEDIA SARL
 *
 */

namespace Beget\MessagePackRpc;

use PHPUnit_Framework_TestCase;

/**
 * Class ClientTest
 *
 * @package EpkmTest\MessagePackRpc
 */
class ClientTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Client
     */
    protected $client;

    public function setUp()
    {
        $this->client = new Client('127.0.0.1', 30001);
    }

    public function tearDown()
    {
        $this->client = null;
    }

    public function testCall()
    {
        $result = $this->client->call('hello1', array(2));

        $this->assertEquals(3, $result);

        $result = $this->client->call('hello2', array(3));

        $this->assertEquals(5, $result);
    }


    public function testLargeData()
    {
        $size   = 100000;

        $result = $this->client->call('largeDataTest', array($size));

        $this->assertEquals($size + 1, count($result));
    }

    /**
     * @expectedException \Beget\MessagePackRpc\Exception\RequestErrorException
     */
    public function testCallFail()
    {
        $this->client->call('fail', array());
    }
}
