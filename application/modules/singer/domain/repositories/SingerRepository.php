<?php

class SingerRepository extends EntityRepository {
	// we might do call by reference for each input in each function below
	private $singerModel;
    private $singerLib;
    public function __construct($singerModel,$singerLib) {
		parent::__construct();
		if(!empty($singerModel) && !empty($singerLib)){
			$this->singerModel = $singerModel;
			$this->singerLib   = $singerLib;
		}
	}
	
	public function find($singerId = NULL, $status = array('live'),$sections=array('basic')){
		//Contract::mustBeNumericValueGreaterThanZero($courseId,'Course ID'); //do not delete this
		$SingerObject 	= false;
		if(empty($singerId)){
            return $SingerObject;
		}
		//$this->_validateSections($sections);
		$singerData = $this->singerLib->getSingerData($singerId,$status,$sections);
		return $this->_populateSingerObject($singerData);
	}


	public function findMultiple($singerIds = array(), $status = array('live'),$sections=array('basic')){
		//Contract::mustBeNumericValueGreaterThanZero($courseId,'Course ID'); //do not delete this
		$singerObjects 	= false;
		if(empty($singerIds)){//check for array also
            return $singerObjects;
		}
		// $this->_validateSections($sections);
		$singersData = $this->singerLib->getMultipleSingersData($singerIds,$status,$sections);
		/*
        */
        return $this->_populateMultiplesingersObjects($singersData,$singerIds);
	}
	private function _populateSingerObject($singerData){

		$singerObjectData 				   	= array();
		$singerObjectData['singerName'] 	= $singerData['singerName'];
		$singerObjectData['singerID'] 		= $singerData['singerID'];
        $singerObject = new singer();
        $this->fillObjectWithData($singerObject,$singerObjectData);
        return $singerObject;
	}

	private function _populateMultipleSingersObjects($singersData,$singerIds){
		$singerObjects = array();
		foreach ($singerIds as $singerId) {
			if(isset($singersData[$singerId])){
				$singerObjects[$singerId] = $this->_populateSingerObject($singersData[$singerId]);
			}
		}
		return $singerObjects;
	}

}
