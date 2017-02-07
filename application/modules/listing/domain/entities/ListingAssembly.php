<?php

class ListingAssembly {
	
	private $ListingObject;
	private $ArtistObject;
    private $UserObject;

	public function getListingObject(){
        return $this->ListingObject;
    }

    public function getArtistObject(){
        return $this->ArtistObject;
    }
    public function getUserObject(){
        return $this->UserObject;
    }

	public function __set($property,$value) {
		$this->$property = $value;
	}
}	
