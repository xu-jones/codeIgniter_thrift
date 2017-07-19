<?php


class Test extends MY_Controller implements \service\test\testAPIIf {

    protected $processName = '\service\test\testAPIProcessor';

    public function testInfo(\service\test\TestReq $req)
    {
//        log_message(LOG_ERROR, 'test.testInfo.req'.json_encode($req));
        $resp = new \service\test\testResp();
        $resp->age = 33;
//        log_message(LOG_ERROR, 'test.testInfo.resp'.json_encode($resp));
        return $resp;
    }

}
