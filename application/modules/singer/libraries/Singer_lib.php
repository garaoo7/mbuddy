<?php

class Singer_lib{

	private $singerModel;
	private $ci;
// we might do call by reference for each input in each function below
	public function __construct($singerModel){
		if(!empty($singerModel)){
			$this->singerModel = $singerModel;
		}
		$this->ci =& get_instance();
	}

	public function getSectionWiseSingerData($singerId){
		$singerData = false;
		if(empty($singerId)){
			return $singerData;
		}

		return $this->singerModel->getSingerData($singerId);
	}

	public function getSectionWiseMultipleSingersData($singerIds,$sections){
		$singersData = false;
		if(empty($singerIds) || !is_array($singerIds) || count($singerIds)==0){ //
			return $singersData;
		}

		return $this->singerModel->getMultipleSingersData($singerIds);
	}	

	public function getRelatedIds($singerIds, $key){
		return $this->singerModel->getRelatedIds($singerIds, $key);
	}
}
?>
