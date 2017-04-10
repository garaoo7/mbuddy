<?php

class Singer {
	
    private $SingerID;
	private $SingerName;
    private $ListingObject;


    public function getSingerUrl(){
        $id     = $this->getSingerID();
        $text   = convertTextToUrl($this->getSingerName());
        return MBUDDY_HOME.$text."/".$id;
    }

    public function getSingerID(){
        return $this->SingerID;
    }
    
	public function getSingerName(){
        return $this->SingerName;
    }

    public function getListingObject(){
        return $this->ListingObject;
    }

	public function __set($property,$value) {
		$this->$property = $value;
	}
}
	