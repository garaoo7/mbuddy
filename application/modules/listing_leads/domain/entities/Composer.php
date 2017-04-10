<?php

class Composer {
	
    private $ComposerID;
	private $ComposerName;
    private $ListingObject;


    public function getComposerUrl(){
        $id     = $this->getComposerID();
        $text   = convertTextToUrl($this->getComposerName());
        return MBUDDY_HOME.$text."/".$id;
    }

    public function getComposerID(){
        return $this->ComposerID;
    }
    
	public function getComposerName(){
        return $this->ComposerName;
    }

    public function getListingObject(){
        return $this->ListingObject;
    }

	public function __set($property,$value) {
		$this->$property = $value;
	}
}
	