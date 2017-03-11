<?php

class Listing_url {

	private $ci;
	private $listingModel;

	public function __construct(){
		$this->ci =& get_instance();
		$this->ci->load->model("listing/listing_model");
		$this->listingModel = new listing_model();
	}


	public function ListingValidation($listingId){
		//validate the listing for the given listingId
		$listingTitle = $this->listingModel->getListingTitle($listingId);
		if($listingTitle == false){
			return false;
		}
		else{
			$url = $this->urlGenerator($listingId, $listingTitle);
			return $url;
		}

	}

	public function urlGenerator($listingId, $listingTitle){
		//generates the url in the format: base_url/title/id

		    //Lower case everything
		    $listingTitle = strtolower($listingTitle);
		    //Make alphanumeric (removes all other characters)
		    $listingTitle = preg_replace("/[^a-z0-9_\s-]/", "", $listingTitle);
		    //Clean up multiple dashes or whitespaces
		    $listingTitle = preg_replace("/[\s-]+/", " ", $listingTitle);
		    //Convert whitespaces and underscore to dash
		    $listingTitle = preg_replace("/[\s_]/", "-", $listingTitle);
		    return base_url("/index.php/$listingTitle/$listingId");
	}


}

?>