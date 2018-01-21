<?php 

class Rating{

	protected $rating_id;
	protected $user;
	protected $rating_score;

	public function getRating_id(){
		return $this->rating_id;
	}

	public function getUser(){
		return $this->user;
	}

	public function setRating_score($rating_score){
		$this->rating_score = $rating_score;
	}

	public function getRating_score(){
		return $this->rating_score;
	}



	
}


?>