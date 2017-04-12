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

	public function getSectionWiseListingData($listingId){
		$listingData = false;
		if(empty($listingId)){
			return $listingData;
		}

		return $this->listingModel->getListingData($listingId);
	}

	public function getSectionWiseMultipleListingsData($listingIds){
		$listingsData = array();
		if(empty($listingIds) || !is_array($listingIds) || count($listingIds)==0){
			return $listingData;
		}
		
		return $this->listingModel->getMultipleListingsData($listingIds);
	}

	public function getRelatedIds($listingIds, $key){
		return $this->listingModel->getRelatedIds($listingIds, $key);
	}
	
}
?>
