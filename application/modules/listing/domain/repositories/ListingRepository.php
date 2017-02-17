<?php

class ListingRepository extends EntityRepository {
	// we might do call by reference for each input in each function below
	private $listingModel;
    private $listingLib;
    private $cacheLib;
    private $caching;
    public function __construct($listingModel,$listingLib) {
    	$this->CI =& get_instance();
		parent::__construct();
		if(!empty($listingModel) && !empty($listingLib)){
			$this->listingModel = $listingModel;
			$this->listingLib   = $listingLib;
		}
		$this->cacheLib = $this->CI->load->library("cache/cache_lib");
		$this->caching = true;
	}
	
	public function find($listingId = NULL, $status = array('live'),$sections=array('basic')){
		//Contract::mustBeNumericValueGreaterThanZero($courseId,'Course ID'); //do not delete this
		$ListingObject 	= false;
		if(empty($listingId)){
            return $ListingObject;
		}
		//$this->_validateSections($sections);

		if($this->caching){
			// $listingObject = $this->cacheLib->getListingObject($listingId,$status,$sections);
			// return;
		}
		$listingData = $this->listingLib->getListingData($listingId,$status,$sections);
		//echo '<pre>'.print_r($listingData,TRUE).'</pre>';
		return $this->_populateListingObject($listingData);
	}


	public function findMultiple($listingIds = array(), $status = array('live'),$sections=array('basic')){
		//Contract::mustBeNumericValueGreaterThanZero($courseId,'Course ID'); //do not delete this
		$listingObjects	= array();
		if(empty($listingIds)){//check for array also
            return $ListingObjects;
		}
		// $this->_validateSections($sections);
		$listingsData = $this->listingLib->getMultipleListingsData($listingIds,$status,$sections);
		$listingObjects = $this->_populateMultipleListingsObjects($listingsData, $listingIds);

		//echo '<pre>'.print_r($listingsData,TRUE).'</pre>';
        return $listingObjects;
	}
	private function _populateListingObject($listingData){

		$listingObjectData 				   	= array();
		$listingObjectData['ListingID'] 	= $listingData['listingData']['ListingID'];
		$listingObjectData['ListingTitle'] 	= $listingData['listingData']['ListingTitle'];
		$listingObjectData['ListingViews'] 	= $listingData['listingData']['ListingViews'];
		$listingObjectData['ListingLikes'] 	= $listingData['listingData']['ListingLikes'];
		$listingObjectData['ListingDislikes']= $listingData['listingData']['ListingDislikes'];
		$listingObjectData['ArtistObject'] 	= $listingData['artistsObject'];
		$listingObjectData['UserObject'] 	= $listingData['userObject'];
        $listingObject = new Listing();
        $this->fillObjectWithData($listingObject,$listingObjectData);
         //echo '<pre>'.print_r($listingData,TRUE).'</pre>';
        return $listingObject;
	}

	private function _populateMultipleListingsObjects($listingsData,$listingIds){
		$listingObjects = array();
		foreach ($listingIds as $listingId) {
			if(isset($listingsData[$listingId])){//echo "<br>";
				$listingObjects[$listingId] = $this->_populateListingObject($listingsData[$listingId]);
			}
		}
		return $listingObjects;
	}

}
