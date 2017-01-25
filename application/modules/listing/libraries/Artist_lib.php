<?php

class Artist_lib{

	private $listingModel;
// we might do call by reference for each input in each function below
	public function __construct($listingModel){
		if(!empty($listingModel)){
			$this->listingModel = $listingModel;
		}
	}

	public function getArtistData($artistId, $status = array('live'),$sections=array('basic')){
		$artistData = false;
		if(empty($artistId)){
			return $artistData;
		}
		// $this->_validateSections($sections); //maybe
		return $this->listingModel->getArtistData($artistId,$status);
	}

	public function getMultipleArtistsData($artistIds, $status = array('live'),$sections=array('basic')){
		$artistsData = false;
		if(empty($artistIds)){ //check for array also
			return $artistsData;
		}
		// $this->_validateSections($sections); //maybe
		// if($sections=='full' || $sections=='artist'){
		// 	load user builder.
		// 	get user repo.
		// 	get artist data.
		// }
		// if($sections)
		return $this->listingModel->getMultipleArtistsData($artistIds,$status);
	}	
	
}
?>
