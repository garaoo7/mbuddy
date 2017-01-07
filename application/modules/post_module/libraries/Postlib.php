<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Postlib {

	public function __construct(){
		$this->load->model('post_model');
	}

   	public function auto_complete_language(){
   	    echo json_encode($this->post_model->autoSuggestion('LanguageName', 'language', 'LanguageID'));
     }

}