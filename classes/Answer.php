<?php

class Answer{

	protected $answer_id;
	protected $answer_title;
	protected $answer_body;
	protected $answer_owner;
	protected $question;
	protected $dateOfCreation;



	public function getAnswer_id(){
		return $this->answer_id;
	}

	public function setAnswer_title($answer_title){
		$this->answer_title = $answer_title;
	}

	public function getAnswer_title(){
		return $this->answer_title;
	}

	public function setAnswer_body($answer_body){
		$this->answer_body = $answer_body;
	}

	public function getAnswer_body(){
		return $this->answer_body;
	}


	public function getAnswer_owner(){
		return $this->answer_owner;
	}


	public function getQuestion(){
		return $this->question;
	}

	public function setDateOfCreation($dateOfCreation){
		$this->dateOfCreation = $dateOfCreation;
	}
	public function getDateOfCreation(){
		return $this->dateOfCreation;
	}



	public function addAnswer($sent_answer_text, $sent_answer_owner, $sent_question_id){
		global $database;

		$date = date('Y-m-d H:i:s');
        $final = strtotime($date);
        $dateOfCreation1 = date('Y-m-d H:i:s', $final);


       
       	$sql = "INSERT INTO answers(answer_text, answer_owner, question, dateOfCreation) VALUES('$sent_answer_text','$sent_answer_owner', '$sent_question_id', '$dateOfCreation1')";


        $resultSet = $database->query($sql);

        if($database->affectedRows($resultSet)){
        	return 1;
		}else{
			return 0;
		}
	}

	public function getAnswersOfQuestion($sent_question_id){

		global $database;

		$sql = "SELECT * FROM answers WHERE question = '$sent_question_id'";
		$resultSet = $database->query($sql);
		$result = $database->numRows($resultSet);
		if($result){

			$this->getMessage("answers have been fetched from DB!");
			$answers = array();

			while($row = $resultSet->fetch_assoc()){
				
			  	// add each row returned into an array
			  	$answers[] = $row;
			}
			return $answers;
		}else{
			return 0;
		}
	}

	protected function getMessage($msg){
        echo "
            <script>
                alert('$msg');
            </script>
        ";
    }


    public function sanitize($input){
        global $database;
        
        $sanitizedInput = $database->escapeString(trim($input));
        return $sanitizedInput;
    }
}



 ?>