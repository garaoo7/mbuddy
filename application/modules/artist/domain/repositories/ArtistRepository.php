<?php

class ArtistRepository extends EntityRepository {
	// we might do call by reference for each input in each function below
	private $artistModel;
    private $artistLib;
    private $artistCache;
    private $caching;
    public function __construct($artistModel,$artistLib,$artistCache) {
    	$this->CI =& get_instance();
		parent::__construct();
		if(!empty($artistModel) && !empty($artistLib)){
			$this->artistModel = $artistModel;
			$this->artistLib   = $artistLib;
			$this->artistCache = $artistCache;
		}
		$this->caching = true;
		$this->CI->load->config('artist/artistConfig');
	}
	
	public function find($artistId = NULL, $status = array('live'),$sections=array('basic')){
		//Contract::mustBeNumericValueGreaterThanZero($courseId,'Course ID'); //do not delete this
		$ArtistObject 	= false;
		if(empty($artistId)){
            return $ArtistObject;
		}
		Contract::mustBeNumericValueGreaterThanZero($artistId,'Course ID');

		$this->_validateSections($sections);
		if($this->caching && $dataFromCache = $this->artistCache->getArtistObjectFromCache($artistId,$sections)){
			$artistObject = $this->_populateArtistObject($dataFromCache,$sections);
			//_p($artistObject);
			return $artistObject;
		}
		$artistData = $this->artistLib->getSectionWiseArtistData($artistId);

		if(!empty($artistData)){
			$artistObject = $this->_populateArtistObject($artistData,$sections);
			if($this->caching){
				$this->artistCache->storeArtistObject($artistId,$artistData);	
			}	
		}
		return $artistObject;
		//$this->_validateSections($sections);;
	}


	public function findMultiple($artistIds = array(), $status = array('live'),$sections = array('basic')){
		$artistObjects	= array();
		if(empty($artistIds)){
			return $artistObjects;
		}
		Contract::mustBeNonEmptyArrayOfIntegerValues($artistIds,'Course IDs'); //do not delete this
		$this->_validateSections($sections);
		$dataFromCache = array();
		if($this->caching){
			$dataFromCache = $this->artistCache->getMultipleArtistObjectsFromCache($artistIds,$sections);
		}
		$artistIdsFromCache 	= array_keys($dataFromCache);
		$artistIdsFromDb 		= array_diff($artistIds,$artistIdsFromCache);
		$artistsDataFromDb 	= $this->artistLib->getSectionWiseMultipleArtistsData($artistIdsFromDb);

		if(!empty($dataFromCache)){
			$artistObjectsFromCache  = $this->_populateMultipleArtistsObjects($dataFromCache, $artistIdsFromCache,$sections);
		}

		if(!empty($artistsDataFromDb)){
			$artistObjectsFromDB = $this->_populateMultipleArtistsObjects($artistsDataFromDb, $artistIdsFromDb,$sections);
			if($this->caching){
				$this->artistCache->storeMultipleArtistObject($artistIdsFromDb,$artistsDataFromDb);
			}
		}

		$artistObjects  = (array)$artistObjectsFromCache + (array)$artistObjectsFromDB;

		//echo '<pre>'.print_r($artistsData,TRUE).'</pre>';
        return $artistObjects;
	}

	private function _populateArtistObject($artistData,$sections){
		$artistObject = new Artist();
		foreach ($artistData as $section => $sectionData) {
			if(in_array($section, $sections)){
				switch ($section) {
					case 'basic':
						$this->fillArtistBasicdata($artistObject,$sectionData);
						break;
					default:
						break;
				}
			}
		}
         //echo '<pre>'.print_r($artistData,TRUE).'</pre>';
        return $artistObject;
	}

	private function _populateMultipleArtistsObjects($artistsData,$artistIds,$sections){
		
		$artistObjects = array();
		foreach ($artistIds as $artistId) {
			if(isset($artistsData[$artistId])){//echo "<br>";
				$artistObjects[$artistId] = $this->_populateArtistObject($artistsData[$artistId],$sections);
			}
		}
		return $artistObjects;
	}

	private function _validateSections(&$sections){
		global $artistSections;
		if(in_array('full', $sections)){
			$sections = $artistSections;
		}
		foreach ($sections as $key => $sectionName) {
			if(!in_array($sectionName, $artistSections)){
				unset($sections[$key]);
			}
		}
		if(!in_array('basic', $sections)){
			$sections[] ='basic';
		}
	}
	private function fillArtistBasicdata($artistObject,$sectionData){
		$this->fillObjectWithData($artistObject,$sectionData);
	}
}
