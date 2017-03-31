<?php

class Singer_lib{

	private $singerModel;
// we might do call by reference for each input in each function below
	public function __construct($singerModel){
		if(!empty($singerModel)){
			$this->singerModel = $singerModel;
		}
	}

	public function getSingerData($singerId, $status = array('live'),$sections=array('basic')){
		$singerData = false;
		if(empty($singerId)){
			return $singerData;
		}
		// $this->_validateSections($sections); //maybe
		return $this->singerModel->getSingerData($singerId,$status);
	}

	public function getMultipleSingersData($singerIds, $status = array('live'),$sections='basic'){
		$singersData = false;
		if(empty($singerIds)){ //check for array also
			return $singersData;
		}
		// $this->_validateSections($sections); //maybe
		// if($sections=='full' || $sections=='singer'){
		// 	load user builder.
		// 	get user repo.
		// 	get singer data.
		// }
		// if($sections)
		return $this->singerModel->getMultipleSingersData($singerIds,$status);
	}	
	
}
?>
