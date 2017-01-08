<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mbuddy extends MX_Controller {

    public function index(){
        $this->load->view('common/homepage');
    }
}

?>