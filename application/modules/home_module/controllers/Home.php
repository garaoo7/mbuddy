<?php

class Home extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("user_module/user_model");
        
    }

    public function index(){
        $this->load->view('homepage');
    }
}

?>