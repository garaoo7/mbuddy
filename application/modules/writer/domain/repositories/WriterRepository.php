<?php

class ArtistRepository extends EntityRepository {
	// we might do call by reference for each input in each function below
	private $artistModel;
    private $artistLib;
    public function __construct($artistModel,$artistLib) {
		parent::__construct();
		if(!empty($artistModel) && !empty($artistLib)){
			$this->artistModel = $artistModel;
			$this->artistLib   = $artistLib;
		}
	}
	
	public function find($artistId = NULL, $status = array('live'),$sections=array('basic')){
		//Contract::mustBeNumericValueGreaterThanZero($courseId,'Course ID'); //do not delete this
		$ArtistObject 	= false;
		if(empty($artistId)){
            return $ArtistObject;
		}
		//$this->_validateSections($sections);
		$artistData = $this->artistLib->getArtistData($artistId,$status,$sections);
		return $this->_populateArtistObject($artistData);
	}


	public function findMultiple($artistIds = array(), $status = array('live'),$sections=array('basic')){
		//Contract::mustBeNumericValueGreaterThanZero($courseId,'Course ID'); //do not delete this
		$artistObjects 	= false;
		if(empty($artistIds)){//check for array also
            return $artistObjects;
		}
		// $this->_validateSections($sections);
		$artistsData = $this->artistLib->getMultipleArtistsData($artistIds,$status,$sections);
		/*
        */
        return $this->_populateMultipleArtistsObjects($artistsData,$artistIds);
	}
	private function _populateArtistObject($artistData){

		$artistObjectData 				   	= array();
		$artistObjectData['artistName'] 	= $artistData['artistName'];
		$artistObjectData['artistID'] 		= $artistData['artistID'];
        $artistObject = new artist();
        $this->fillObjectWithData($artistObject,$artistObjectData);
        return $artistObject;
	}

	private function _populateMultipleArtistsObjects($artistsData,$artistIds){
		$artistObjects = array();
		foreach ($artistIds as $artistId) {
			if(isset($artistsData[$artistId])){
				$artistObjects[$artistId] = $this->_populateArtistObject($artistsData[$artistId]);
			}
		}
		return $artistObjects;
	}

}
