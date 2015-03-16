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

// Please run client.php

/** @var Composer\Autoload\ClassLoader $loader */
include_once __DIR__ . '/../vendor/autoload.php';

class App
{
    public function hello1($a)
    {
        return $a + 1;
    }

    public function hello2($a)
    {
        return $a + 2;
    }

    public function timeoutTest()
    {
        sleep(15);

        return true;
    }

    public function fail()
    {
        throw new Exception('hoge');
    }

    public function largeDataTest($size)
    {
        $a = array();

        foreach(range(0, $size) as $i) {
            $a[] = [
                "test" => $i,
                $i + 10,
                $i => $size + 10
            ];
        }

        return $a;
    }
}

function testIs($no, $a, $b)
{
    if ($a === $b) {
        echo "OK:{$no}/{$a}/{$b}\n";
    } else {
        echo "NO:{$no}/{$a}/{$b}\n";
    }
}

try {
    $server = new \LTDBeget\MessagePackRpc\Server('30002', new App());
    $server->recv();
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}
exit;
