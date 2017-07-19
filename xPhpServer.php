<?php
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

class xHandler implements \service\x\xAPIIf   {


    public function xInfo(\service\x\xReq $req)
    {
        $resp = new \service\x\xResp();
        $resp->age = 123;
        return $resp;
    }


};

header('Content-Type', 'application/x-thrift');

$handler = new xHandler();
$processor = new \service\x\xAPIProcessor($handler);

$transport = new TBufferedTransport(new TPhpStream(TPhpStream::MODE_R | TPhpStream::MODE_W));
$protocol = new TBinaryProtocol($transport, true, true);

$transport->open();
$processor->process($protocol, $protocol);
$transport->close();