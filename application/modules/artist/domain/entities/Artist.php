<?php

class Artist {

	private $ArtistID;
	private $ArtistName;

    public function getArtistID(){
         return $this->ArtistID;
    }

	public function getArtistName(){
        return $this->ArtistName;
    }

	public function __set($property,$value) {
		$this->$property = $value;
	}
}	
	