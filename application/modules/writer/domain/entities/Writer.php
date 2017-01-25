<?php

class Artist {

	private $artistName;
	private $artistID;

	public function getArtistName(){
        return $this->ArtistName;
    }

    public function getArtistID(){
                return $this->ArtistID;
    }
	public function __set($property,$value) {
		$this->$property = $value;
	}
}	
	