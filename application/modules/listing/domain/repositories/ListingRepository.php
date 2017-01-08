<?php

class ListingRepository extends EntityRepository {
	// we might do call by reference for each input in each function below
	private $listingModel;
    private $listingLib;
    public function __construct($listingModel,$listingLib) {
		parent::__construct();
		if(!empty($listingModel) && !empty($listingLib)){
			$this->listingModel = $listingModel;
			$this->listingLib   = $listingLib;
		}
	}
	
	public function find($listingId = NULL, $status = array('live'),$sections=array('basic')){
		//Contract::mustBeNumericValueGreaterThanZero($courseId,'Course ID'); //do not delete this
		$ListingObject 	= false;
		if(empty($listingId)){
            return $ListingObject;
		}
		//$this->_validateSections($sections);
		$listingData = $this->listingLib->getListingData($listingId,$status,$sections);
		return $this->_populateListingObject($listingData);
	}


	public function findMultiple($listingIds = array(), $status = array('live'),$sections=array('basic')){
		//Contract::mustBeNumericValueGreaterThanZero($courseId,'Course ID'); //do not delete this
		$ListingObjects 	= false;
		if(empty($listingIds)){//check for array also
            return $ListingObjects;
		}
		// $this->_validateSections($sections);
		$listingsData = $this->listingLib->getMultipleListingsData($listingIds,$status,$sections);
		/*
        */
        return $this->_populateMultipleListingsObjects($listingsData,$listingIds);
	}
	private function _populateListingObject($listingData){

		$listingObjectData 				   	= array();
		$listingObjectData['ListingTitle'] 	= $listingData['ListingTitle'];
		$listingObjectData['ListingViews'] 	= $listingData['ListingViews'];
        $listingObject = new Listing();
        $this->fillObjectWithData($listingObject,$listingObjectData);
        return $listingObject;
	}

	private function _populateMultipleListingsObjects($listingsData,$listingIds){
		$listingObjects = array();
		foreach ($listingIds as $listingId) {
			if(isset($listingsData[$listingId])){
				$listingObjects[$listingId] = $this->_populateListingObject($listingsData[$listingId]);
			}
		}
		return $listingObjects;
	}

}
