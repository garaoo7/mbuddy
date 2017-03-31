<?php

class Listing_url {

	private $ci;
	private $listingModel;

	public function __construct(){
		$this->ci =& get_instance();
		$this->ci->load->model("listing/listing_model");
		$this->listingModel = new listing_model();
	}
//url_builder lib name
	//validate_url for below function

	public function getListingUrl($listingId){
		//validate the listing for the given listingId
		$listingTitle = $this->listingModel->getListingTitle($listingId);
		if($listingTitle == false){
			return false;
		}
		else{
			$url = convertTextToUrl($listingTitle);
			return "$url/$listingId";
		}

	}
}

?>