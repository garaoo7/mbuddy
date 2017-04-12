<?php
class User_cache{
	private $redisClient;
	private $userCacheKeyPrefix='user';
	function __construct(){
		$this->redisClient = PredisLibrary::getInstance();
	}
	
	function getUserObjectFromCache($userId,$sections){
		$key = $this->userCacheKeyPrefix.$userId;
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

	function storeUserObject($userId,$userData){
		$key = $this->userCacheKeyPrefix.$userId;
		foreach ($userData as &$value) {
			$value = serialize($value);
		}
		try{
			$this->redisClient->addMembersToHash($key,$userData);
		}
		catch(Exception $e){

		}
	}

	function storeMultipleUserObject($userIds,$usersData){
		try
		{
			foreach ($userIds as $userId) {
				$key = $this->userCacheKeyPrefix.$userId;
				if(!empty($usersData[$userId])){
					foreach ($usersData[$userId] as &$value) {
						$value = serialize($value);			
					}

					$this->redisClient->addMembersToHash($key,$usersData[$userId],false,true);
				}
			}
			$this->redisClient->executePipeLine();
		}
		catch(Exception $e){

		}
	}
	function getMultipleUserObjectsFromCache($userIds,$sections){
		try
		{
			foreach ($userIds as $userId) {
				$key = $this->userCacheKeyPrefix.$userId;
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
			$returnArray[$value['basic']['UserID']] = $value;
		}
		return $returnArray;
		
	}
}
?>