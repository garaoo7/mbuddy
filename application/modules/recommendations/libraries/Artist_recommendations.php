<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	
class Artist_recommendations {
	private $CI;

	function __construct(){
		$this->CI =& get_instance();

		$this->CI->load->model("recommendations/listing_recommendations_model");
		$this->listing_recommendations_model = new listing_recommendations_model();
	}

	public function get_recent_artists($userValidation){
		return	$this->listing_recommendations_model->get_recent_artists($userValidation);
	}
}