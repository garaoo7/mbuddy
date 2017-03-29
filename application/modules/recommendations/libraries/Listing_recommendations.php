<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	
class Listing_recommendations {
	private $CI;

	function __construct(){
		$this->CI =& get_instance();

		$this->CI->load->model("recommendations/listing_recommendations_model");
		$this->listing_recommendations_model = new listing_recommendations_model();
	}

	public function get_recent_listings($userValidation){
		return	$this->listing_recommendations_model->get_recent_listings($userValidation);
	}

	public function get_more_listings($userValidation, $offset){
		return	$this->listing_recommendations_model->get_more_listings($userValidation, $offset);
	}
}