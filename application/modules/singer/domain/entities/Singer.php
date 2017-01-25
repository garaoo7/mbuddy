<?php

class Singer {

	private $singerName;
	private $singerID;

	public function getSingerName(){
        return $this->SingerName;
    }

    public function getSingerID(){
                return $this->SingerID;
    }
	public function __set($property,$value) {
		$this->$property = $value;
	}
}	
	