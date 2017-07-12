<?php

/**
 * Created by PhpStorm.
 * User: xch
 * Date: 7/10/17
 * Time: 3:46 PM
 */

use Thrift\Protocol\TJSONProtocol;
use Thrift\Transport\TPhpStream;
use Thrift\Transport\TFramedTransport;

class MY_Controller extends CI_Controller
{
    const LOG_PREFIX = 'controller.MY_Controller.';
    public function __construct()
    {
        parent::__construct();
    }

    public function thrift()
    {
        $beginTime = microtime(true);
        $uri = $_SERVER['REQUEST_URI'];
        $transport = new TFramedTransport(new TPhpStream(TPhpStream::MODE_R | TPhpStream::MODE_W));
//        $protocal = new TBinaryProtocol($transport);
        $protocal = new TJSONProtocol($transport);

        $process = new $this->processName($this);
        $transport->open();
        try
        {
            $process->process($protocal, $protocal);
        }
        catch (\Thrift\Exception\TException $e)
        {
            log_message(LEVEL_ERROR, self::LOG_PREFIX.__FUNCTION__." thrift exception code[{$e->getCode()}] msg[{$e->getMessage()}] trace[{$e->getTraceAsString()}]");
        }
        $processTime = round((microtime(true) - $beginTime) * 1000, 3);
        $len = strlen(file_get_contents("php://input"));
        log_message($this->logLevelInfo, "MY_Controller uri[{$uri}] len[{$len}] processTime[{$processTime}]");
        $transport->close();
    }

}