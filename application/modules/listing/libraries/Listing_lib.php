<?php

class Listing_lib{

	private $listingModel;
	private $ci;
// we might do all by reference for each input in each function below
	public function __construct($listingModel){
		if(!empty($listingModel)){
			$this->listingModel = $listingModel;
		}
		$this->ci =& get_instance();
	}

	public function getListingData($listingId, $status = array('live'),$sections=array('basic')){
		$listingData = false;
		if(empty($listingId)){
			return $listingData;
		}

		return $this->listingModel->getListingData($listingId,$status,$sections);
	}

	public function getMultipleListingsData($listingIds, $status = array('live'),$sections=array('basic')){
		$listingsData = false;
		if(empty($listingIds)){ //check for array also
			return $listingsData;
		}

		return $this->listingModel->getMultipleListingsData($listingIds,$status,$sections);
	}
	
}
?>
