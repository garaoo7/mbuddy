<?php

class Listing {
	
	private $ListingTitle;
	private $ListingViews;
	private $ListingLikes;
	private $ListingDislikes;
	private $ArtistObject;

	public function getListingTitle(){
        return $this->ListingTitle;
    }

    public function getListingViews(){
        return $this->ListingViews;
    }

    public function getListingLikes(){
        return $this->ListingLikes;
    }

    public function getListingDislikes(){
        return $this->ListingDislikes;
    }

    public function getArtistObject(){
        return $this->ArtistObject;
    }

	public function __set($property,$value) {
		$this->$property = $value;
	}
}	
	