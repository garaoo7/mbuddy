<?php

class Tag {
	
    private $TagID;
	private $TagName;
	private $TagCreatedBy;
    private $TagCreationDate;
    private $ListingObject;
	private $UserObject;

    public function getTagUrl(){
        $id     = $this->getTagID();
        $text   = convertTextToUrl($this->getTagName());
        return MBUDDY_HOME.$text."/".$id;
    }

    public function getTagID(){
        return $this->TagID;
    }
    
	public function getTagName(){
        return $this->TagName;
    }

    public function getTagCreatedBy(){
        return $this->TagCreatedBy;
    }

    public function getTagCreationDate(){
        return $this->TagCreationDate;
    }

    public function getListingObject(){
        return $this->ListingObject;
    }
    
    public function getUserObject(){
        return $this->UserObject;
    }

	public function __set($property,$value) {
		$this->$property = $value;
	}
}	
	