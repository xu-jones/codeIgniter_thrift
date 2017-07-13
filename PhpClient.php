<?php

error_reporting(E_ALL);

require_once __DIR__ . '/application/libraries/Thrift/ClassLoader/ThriftClassLoader.php';

use Thrift\ClassLoader\ThriftClassLoader;

$GEN_DIR = './idl/gen-php';

$loader = new ThriftClassLoader();
$loader->registerNamespace('Thrift', __DIR__ . '/application/libraries');
$loader->registerDefinition('service', $GEN_DIR);
$loader->register();


use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\THttpClient;
use Thrift\Transport\TBufferedTransport;
use Thrift\Exception\TException;

try {

    $socket = new THttpClient('10.21.200.75', 9758, '/PhpServer.php');

    $transport = new TBufferedTransport($socket, 1024, 1024);
    $protocol = new TBinaryProtocol($transport);
    $client = new \service\test\TestAPIClient($protocol);

    $transport->open();
    $req = new \service\test\testReq();
    $req->name = 'xch';
    $head = new \service\test\MsgHeader();
    $head->uid = 1;
    $req->header = $head;
    $a = $client->testInfo($req);
    $transport->close();
    print_r($a);

} catch (TException $tx) {
    print 'TException: ' . $tx->getMessage() . "\n";
}

?>