<?php
require_once __DIR__ . '/application/libraries/Thrift/ClassLoader/ThriftClassLoader.php';

use Thrift\ClassLoader\ThriftClassLoader;

$GEN_DIR = './idl/gen-php';

$loader = new ThriftClassLoader();
$loader->registerNamespace('Thrift', __DIR__ . '/application/libraries');
$loader->registerDefinition('service', $GEN_DIR);
$loader->register();


use Thrift\Protocol\TBinaryProtocol;
use Thrift\Protocol\TJSONProtocol;
use Thrift\Transport\THttpClient;
use Thrift\Transport\TBufferedTransport;
use Thrift\Exception\baseException;

try {

    $socket = new THttpClient('10.21.200.75', 9758, 'xPhpServer.php');

    $transport = new TBufferedTransport($socket, 1024, 1024);
    $protocol = new TBinaryProtocol($transport);
    $client = new \service\x\xAPIClient($protocol);

    $transport->open();
    $req = new \service\x\xReq();
    $req->name = 'xch';
    $header = new \service\base\baseReqHeader();
    $header->uid = 1;
    $req->header = $header;
    $a = $client->xInfo($req);
    $transport->close();
    print_r($a);

} catch (baseException $tx) {
    print 'baseException: ' . $tx->getMessage() . "\n";
}

?>