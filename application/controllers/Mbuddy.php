<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mbuddy extends MX_Controller {
	function __construct(){
		parent::__construct();
		$this->load->builder('Artist_builder','artist');
		$this->ArtistBuilder = new Artist_builder();
		$this->ArtistRepository = $this->ArtistBuilder->getArtistRepository();

		$this->userValidation = $this->check_user_validation();

	}
    public function index(){
        $recentArtists = $this->get_recent_listings();
        $artistsObject = $this->ArtistRepository->findMultiple($recentArtists, 'live', 'basic');
        // echo "<br>";
        $displayData['artistData'] = $artistsObject;
        $this->load->view('common/homepage',$displayData);
        // $this->load->view('common/homepage');
        echo '<pre>'.print_r($artistsObject,TRUE).'</pre>';
    }

    public function get_recent_listings(){

   $this->load->library('recommendations/artist_recommendations');
	   	return $this->artist_recommendations->get_recent_artists($this->userValidation);
    }
}

?>