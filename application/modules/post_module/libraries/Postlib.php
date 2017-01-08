<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Postlib {
	private static $CI;

	public function __construct(){
		self::$CI =& get_instance();
		self::$CI->load->model('post_module/post_model');
	}

	public function auto_complete($value){
		$nameColoumn = ucfirst($value)."Name";
		$idColoumn = ucfirst($value)."ID";
	    return self::$CI->post_model->autoSuggestion($nameColoumn, $value, $nameColoumn);
  	}

}