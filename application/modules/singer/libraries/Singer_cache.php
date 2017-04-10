<?php
class Singer_cache{
	private $redisClient;
	private $singerCacheKeyPrefix='singer';
	function __construct(){
		$this->redisClient = PredisLibrary::getInstance();
	}
	
	function getSingerObjectFromCache($singerId,$sections){
		$key = $this->singerCacheKeyPrefix.$singerId;
		try{
			$dataFromCache = $this->redisClient->getMembersOfHashByFieldNameWithValue($key,$sections);
		}
		catch(Exception $e){

		}
		if(is_array($dataFromCache)){
			foreach ($dataFromCache as &$value) {
				$value = unserialize($value);
			}	
		}
		if(!$dataFromCache['basic'])
			return false;
		return $dataFromCache;	
	}

	function storeSingerObject($singerId,$singerData){
		$key = $this->singerCacheKeyPrefix.$singerId;
		foreach ($singerData as &$value) {
			$value = serialize($value);
		}
		try{
			$this->redisClient->addMembersToHash($key,$singerData);
		}
		catch(Exception $e){

		}
	}

	function storeMultipleSingerObject($singerIds,$singersData){
		try
		{
			foreach ($singerIds as $singerId) {
				$key = $this->singerCacheKeyPrefix.$singerId;
				if(!empty($singersData[$singerId])){
					foreach ($singersData[$singerId] as &$value) {
						$value = serialize($value);			
					}

					$this->redisClient->addMembersToHash($key,$singersData[$singerId],false,true);
				}
			}
			$this->redisClient->executePipeLine();
		}
		catch(Exception $e){

		}
	}
	function getMultipleSingerObjectsFromCache($singerIds,$sections){
		try
		{
			foreach ($singerIds as $singerId) {
				$key = $this->singerCacheKeyPrefix.$singerId;
				$dataFromCache = $this->redisClient->getMembersOfHashByFieldNameWithValue($key,$sections,TRUE);
			}
			$dataFromCache = $this->redisClient->executePipeLine();
		}
		catch(Exception $e){

		}
		$dataArray   = array();
		if(is_array($dataFromCache)){
			foreach ($dataFromCache as $key1=>&$value) {
				foreach ($value as $key2=>&$sectionData) {
					if(!empty($sectionData)){
						$sectionData = unserialize($sectionData);	
						$dataArray[$key1][$sections[$key2]] = $sectionData;	
					}
				}
			}	
		}
		$returnArray = array();
		foreach ($dataArray as $key => $value) {
			$returnArray[$value['basic']['SingerID']] = $value;
		}
		return $returnArray;
		
	}
}
?>