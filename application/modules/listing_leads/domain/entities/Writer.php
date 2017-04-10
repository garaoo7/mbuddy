<?php

class Writer {
	
    private $WriterID;
	private $WriterName;
    private $ListingObject;


    public function getWriterUrl(){
        $id     = $this->getWriterID();
        $text   = convertTextToUrl($this->getWriterName());
        return MBUDDY_HOME.$text."/".$id;
    }

    public function getWriterID(){
        return $this->WriterID;
    }
    
	public function getWriterName(){
        return $this->WriterName;
    }

    public function getListingObject(){
        return $this->ListingObject;
    }

	public function __set($property,$value) {
		$this->$property = $value;
	}
}
	