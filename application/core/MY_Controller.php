<?php

/**
 * Created by PhpStorm.
 * User: xch
 * Date: 7/10/17
 * Time: 3:46 PM
 */

use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\TPhpStream;
use Thrift\Transport\TBufferedTransport;

class MY_Controller extends CI_Controller
{
    protected $processName;

    const LOG_PREFIX = 'controller.MY_Controller.';
    public function __construct()
    {
        parent::__construct();
    }

    public function thrift()
    {
//        header('Content-Type', 'application/x-thrift');

        $beginTime = microtime(true);
        $uri = $_SERVER['REQUEST_URI'];
        $transport = new TBufferedTransport(new TPhpStream(TPhpStream::MODE_R | TPhpStream::MODE_W));
        $protocal = new TBinaryProtocol($transport, true, true);

        /**@var \service\test\testAPIProcessor $process*/
//        require_once(APPPATH.'/controllers/test.php');
        $process = new $this->processName($this);
        $transport->open();
        try
        {
            $process->process($protocal, $protocal);
        }
        catch (\Thrift\Exception\TException $e)
        {
            log_message(LOG_ERROR, 'catch process');
            log_message(LOG_ERROR, " thrift exception code[{$e->getCode()}] msg[{$e->getMessage()}] trace[{$e->getTraceAsString()}]");
        }
        $processTime = round((microtime(true) - $beginTime) * 1000, 3);
        $len = strlen(file_get_contents("php://input"));
        log_message(LOG_ERROR, "MY_Controller uri[{$uri}] len[{$len}] processTime[{$processTime}]");
        $transport->close();
    }

}