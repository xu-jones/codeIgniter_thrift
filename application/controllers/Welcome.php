<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Welcome extends MY_Controller implements \service\test\TestAPIIf {

    public function testInfo(\service\test\TestReq $req)
    {
        $this->load->view('welcome_message');
    }

}
