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

namespace LTDBeget\MessagePackRpc;

use PHPUnit_Framework_TestCase;
use LTDBeget\MessagePackRpc\Exception\TimeoutException;

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
        $this->client = new Client('127.0.0.1', 30002);
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

    /**
     * @expectedException \LTDBeget\MessagePackRpc\Exception\TimeoutException
     */
    public function testTimeout()
    {
        $this->client->setSocketTimeout(10);
        $this->client->call('timeoutTest', array());
    }

    public function testLargeData()
    {
        $size   = 100000;

        $result = $this->client->call('largeDataTest', array($size));

        $this->assertEquals($size + 1, count($result));
    }

    /**
     * @expectedException \LTDBeget\MessagePackRpc\Exception\RequestErrorException
     */
    public function testCallFail()
    {
        $this->client->call('fail', array());
    }
}
