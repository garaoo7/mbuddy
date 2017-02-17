<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Listing_controller extends MX_Controller{

	public function __construct(){
		// $this->load->library('listing/listing__lib');
		// $this->listingLib = new listing__lib();

	}

	public function index($listingId=142){
		//place checks listingid validation
		echo "<br><br><br><br>";
		echo $listingId;
		$this->load->builder('listing/Listing_builder');
		$this->ListingBuilder = new Listing_builder();
		$this->ListingRepository = $this->ListingBuilder->getListingRepository();
		$listingObject = $this->ListingRepository->find($listingId, array('live'), array('full'));
		$displayData['listingData'] = $listingObject;
		$this->load->view('listingPage', $displayData);
		echo "<br><br><br><br>";
		echo '<pre>'.print_r($listingObject,TRUE).'</pre>';
		// echo $listingObjects[142]->getListingTitle();
		//print_r($listingObjects);
	}
}
?>