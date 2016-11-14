<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class ListingController extends MX_Controller{

	public function index($listingId=1){
		$this->load->builder('ListingBuilder','Listing');
		$ListingBuilder = new ListingBuilder();
		$ListingRepository = $ListingBuilder->getListingRepository();
		$listingObject = $ListingRepository->find($listingId);
		echo '<pre>'.print_r($listingObject,TRUE).'</pre>';
		//print_r("<pre>",$listingObject,"</pre>");


		$listingIds = array(1,2);
		$listingObjects = $ListingRepository->findMultiple($listingIds);
		echo '<pre>'.print_r($listingObjects,TRUE).'</pre>';
		//print_r($listingObjects);
	}
}



  ?>