<?php

class ListingLib{

	private $listingModel;
// we might do call by reference for each input in each function below
	public function __construct($listingModel){
		if(!empty($listingModel)){
			$this->listingModel = $listingModel;
		}
	}

	public function getListingData($listingId, $status = array('live'),$sections=array('basic')){
		$listingData = false;
		if(empty($listingId)){
			return $listingData;
		}
		// $this->_validateSections($sections); //maybe
		return $this->listingModel->getListingData($listingId,$status);
	}

	public function getMultipleListingsData($listingIds, $status = array('live'),$sections=array('basic')){
		$listingsData = false;
		if(empty($listingIds)){ //check for array also
			return $listingsData;
		}
		// $this->_validateSections($sections); //maybe
		return $this->listingModel->getMultipleListingsData($listingIds,$status);
	}	
	
}
?>
