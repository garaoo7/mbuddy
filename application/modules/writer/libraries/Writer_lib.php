<?php

class Artist_lib{

	private $artistModel;
// we might do call by reference for each input in each function below
	public function __construct($artistModel){
		if(!empty($artistModel)){
			$this->artistModel = $artistModel;
		}
	}

	public function getArtistData($artistId, $status = array('live'),$sections=array('basic')){
		$artistData = false;
		if(empty($artistId)){
			return $artistData;
		}
		// $this->_validateSections($sections); //maybe
		return $this->artistModel->getArtistData($artistId,$status);
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
		return $this->artistModel->getMultipleArtistsData($artistIds,$status);
	}	
	
}
?>
