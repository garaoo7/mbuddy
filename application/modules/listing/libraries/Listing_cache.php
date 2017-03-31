<?php
class Listing_cache{

	function __construct(){
		$this->redisClient = PredisLibrary::getInstance();

		$this->redisClient->set("foo",'baar');
		_p($this->redisClient->get("foo"));
		die;
	}
	public function isRedisAlive(){
        	if($this->redisIsAlive > 0){
        		return TRUE;
        	}else{
        		return FALSE;
        	}
    }
}
?>