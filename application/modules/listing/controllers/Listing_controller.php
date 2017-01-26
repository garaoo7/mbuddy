<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Listing_controller extends MX_Controller{

	public function __construct(){
		$this->load->library('listing/listing_assembly_lib');
		$this->listingLib = new listing_assembly_lib();

	}

	public function index($listingId=1){

		//place checks listingid validation
		$listingId = 142;


		$listingObjects = $this->listingLib->getListingsData($listingId, 'live', array('basic'));
		echo '<pre>'.print_r($listingObjects,TRUE).'</pre>';
		echo $listingObjects[142]->getListingTitle();
		//print_r($listingObjects);
	}
}



  ?>