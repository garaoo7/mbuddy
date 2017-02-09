<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Listing_controller extends MX_Controller{

	public function __construct(){
		// $this->load->library('listing/listing_assembly_lib');
		// $this->listingLib = new listing_assembly_lib();

	}

	public function index($listingId=1){
		//place checks listingid validation
		$listingId = 142;

		$this->load->builder('listing/Listing_assembly_builder');
		$this->ListingAssemblyBuilder = new Listing_assembly_builder();
		$this->ListingAssemblyRepository = $this->ListingAssemblyBuilder->getListingAssemblyRepository();
		$listingObject = $this->ListingAssemblyRepository->find($listingId, array('live'), array('full'));
		$displayData['listingData'] = $listingObject;
		$this->load->view('listingPage', $displayData);
		echo "<br><br><br><br>";
		echo '<pre>'.print_r($listingObject,TRUE).'</pre>';
		// echo $listingObjects[142]->getListingTitle();
		//print_r($listingObjects);
	}
}
?>