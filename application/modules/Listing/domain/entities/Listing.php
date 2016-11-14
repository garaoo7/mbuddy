<?php

class Listing {
	
	private $ListingTitle;

	private $ListingViews;

	public function getListingTitle(){
        return $this->ListingTitle;
    }

    public function getListingViews(){
                return $this->ListingViews;
    }
	public function __set($property,$value) {
		$this->$property = $value;
	}
}	
	