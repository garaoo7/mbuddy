<?php

class Artist_lib{

	private $artistModel;
	private $ci;
// we might do all by reference for each input in each function below
	public function __construct($artistModel){
		if(!empty($artistModel)){
			$this->artistModel = $artistModel;
		}
		$this->ci =& get_instance();
	}

	public function getSectionWiseArtistData($artistId){
		$artistData = false;
		if(empty($artistId)){
			return $artistData;
		}

		return $this->artistModel->getArtistData($artistId);
	}

	public function getSectionWiseMultipleArtistsData($artistIds){
		$artistsData = array();
		if(empty($artistIds) || !is_array($artistIds) || count($artistIds)==0){
			return $artistData;
		}
		
		return $this->artistModel->getMultipleArtistsData($artistIds);
	}
	
}
?>