<?php

class Producer {
	
    private $ProducerID;
	private $ProducerName;
    private $ListingObject;


    public function getProducerUrl(){
        $id     = $this->getProducerID();
        $text   = convertTextToUrl($this->getProducerName());
        return MBUDDY_HOME.$text."/".$id;
    }

    public function getProducerID(){
        return $this->ProducerID;
    }
    
	public function getProducerName(){
        return $this->ProducerName;
    }

    public function getListingObject(){
        return $this->ListingObject;
    }

	public function __set($property,$value) {
		$this->$property = $value;
	}
}
	