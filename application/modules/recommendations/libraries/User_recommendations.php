<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	
class User_recommendations {
	private $CI;

	function __construct(){
		$this->CI =& get_instance();

		$this->CI->load->model("recommendations/user_recommendations_model");
		$this->user_recommendations_model = new user_recommendations_model();
	}

	public function get_recent_users($userValidation){
		return	$this->user_recommendations_model->get_recent_users($userValidation);
	}
}