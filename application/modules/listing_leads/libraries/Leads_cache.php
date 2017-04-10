<?php
class Leads_cache{
	private $redisClient;
	private $leadsCacheKeyPrefix='leads';
	function __construct(){
		$this->redisClient = PredisLibrary::getInstance();
	}
	
	function getLeadObjectFromCache($lead,$leadId,$sections){
		$key = $this->leadsCacheKeyPrefix.$lead.$leadId;
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

	function storeLeadObject($lead,$leadId,$leadData){
		$key = $this->leadsCacheKeyPrefix.$lead.$leadId;
		foreach ($leadData as &$value) {
			$value = serialize($value);
		}
		try{
			$this->redisClient->addMembersToHash($key,$leadData);
		}
		catch(Exception $e){

		}
	}

	function storeMultipleLeadObject($lead,$leadIds,$leadsData){
		try
		{
			foreach ($leadIds as $leadId) {
				$key = $this->leadsCacheKeyPrefix.$lead.$leadId;
				if(!empty($leadsData[$leadId])){
					foreach ($leadsData[$leadId] as &$value) {
						$value = serialize($value);			
					}

					$this->redisClient->addMembersToHash($key,$leadsData[$leadId],false,true);
				}
			}
			$this->redisClient->executePipeLine();
		}
		catch(Exception $e){

		}
	}
	function getMultipleLeadObjectsFromCache($lead,$leadIds,$sections){
		try
		{
			foreach ($leadIds as $leadId) {
				$key = $this->leadsCacheKeyPrefix.$lead.$leadId;
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
			$returnArray[$value['basic'][ucwords($lead).'ID']] = $value;
		}
		return $returnArray;
		
	}
}
?>