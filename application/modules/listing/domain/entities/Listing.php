<?php

class Listing {
	
	private $ListingTitle;

	private $ListingViews;

	private $Username;

	public function getListingTitle(){
        return $this->ListingTitle;
    }

    public function getListingViews(){
                return $this->ListingViews;
    }

    public function getUsername(){
        return $this->Username;
    }

	public function __set($property,$value) {
		$this->$property = $value;
	}
}	
	