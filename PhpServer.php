<?php


error_reporting(E_ALL);

require_once __DIR__.'/application/libraries/Thrift/ClassLoader/ThriftClassLoader.php';

use Thrift\ClassLoader\ThriftClassLoader;

$GEN_DIR = './idl/gen-php';

$loader = new ThriftClassLoader();
$loader->registerNamespace('Thrift', __DIR__ . '/application/libraries');
$loader->registerDefinition('service', $GEN_DIR);
$loader->register();


use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\TPhpStream;
use Thrift\Transport\TBufferedTransport;

class testHandler implements \service\test\TestAPIIf  {


    public function testInfo(\service\test\TestReq $req)
    {
        file_put_contents('/home/xch9758/a.log', json_encode($req).PHP_EOL, FILE_APPEND);
        $resp = new \service\test\TestResp();
        $resp->age = 33;
        return $resp;
    }


};

header('Content-Type', 'application/x-thrift');

$handler = new testHandler();
$processor = new \service\test\TestAPIProcessor($handler);

$transport = new TBufferedTransport(new TPhpStream(TPhpStream::MODE_R | TPhpStream::MODE_W));
$protocol = new TBinaryProtocol($transport, true, true);

$transport->open();
$processor->process($protocol, $protocol);
$transport->close();