<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Listing_controller extends MX_Controller{

	public function __construct(){
		// $this->load->library('listing/listing_assembly_lib');
		// $this->listingLib = new listing_assembly_lib();

	}

	public function index($listingId=1){

		//place checks listingid validation
		$listingId = 142;

		$this->load->builder('listing/Listing_builder');
		$this->ListingBuilder = new Listing_builder();
		$this->ListingRepository = $this->ListingBuilder->getListingRepository();
		$listingObject = $this->ListingRepository->find($listingId, array('live'), array('full'));
		// echo '<pre>'.print_r($listingObject,TRUE).'</pre>';
		// echo $listingObjects[142]->getListingTitle();
		//print_r($listingObjects);
	}
}



  ?>