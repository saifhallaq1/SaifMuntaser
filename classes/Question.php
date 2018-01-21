<?php 
class Question{

	protected $question_id;
	protected $question_title;
	protected $question_body;
	protected $question_owner;
	protected $dateOfCreation;
	protected $category;	

	public function getQuestion_id(){
		return $this->question_id;
	}

	public function setQuestion_title($question_title){
		$this->question_title = $question_title;
	}

	public function getQuestion_title(){
		return $this->question_title;
	}

	public function setQuestion_body($question_body){
		$this->question_body = $question_body;
	}

	public function getQuestion_body(){
		return $this->question_body;
	}

	public function setQuestion_owner($question_owner){
		$this->question_owner = $question_owner;
	}

	public function getQuestion_owner(){
		return $this->question_owner;
	}

	public function setDateOfCreation($dateOfCreation){
		$this->dateOfCreation = $dateOfCreation;
	}
	public function getDateOfCreation(){
		return $this->dateOfCreation;
	}

	public function setCategory($category){
		$this->category = $category;
	}
	public function getCategory(){
		return $this->category;
	}



	public function addQuestion($sent_question_title, $sent_question_body, $sent_question_owner, $sent_category){
		global $database;

		$date = date('Y-m-d H:i:s');
        $final = strtotime($date);
        $dateOfCreation1 = date('Y-m-d H:i:s', $final);


       
       	$sql = "INSERT INTO questions(question_title, question_body, question_owner, dateOfCreation, category) VALUES('$sent_question_title', '$sent_question_body','$sent_question_owner' , '$dateOfCreation1', '$sent_category')";


        $resultSet = $database->query($sql);

        if($database->affectedRows($resultSet)){
        	if($database->last_id() != 0){

    		$this->getQuestionInfoFromDatabase($database->last_id());

       		}
 			return 1;
        	
        }else{
        	return 0;
        }


	}


	public function getAllQuestions(){
		global $database;

		$sql = "SELECT * FROM questions";

		$resultSet = $database->query($sql);
		$result = $database->numRows($resultSet);
		if($result){
			$this->getMessage("Questions have been fetched from DB!");
			$questions = array();

			while($row = $resultSet->fetch_assoc()){
				
			  	// add each row returned into an array
			  	$questions[] = $row;
			}
			return $questions;
		}else{
			
			$this->getMessage("Fetching questions from DB didnt work!");
			return 0;
		}
	}


	public function getQuestionsbyCategory($sent_category){
		global $database;

		$sql = "SELECT * FROM questions WHERE category = '$sent_category' ";

		$resultSet = $database->query($sql);
		$result = $database->numRows($resultSet);
		if($result){
			$this->getMessage("Questions have been fetched from DB!");
			$questions = array();

			while($row = $resultSet->fetch_assoc()){
				
			  	// add each row returned into an array
			  	$questions[] = $row;
			}
			return $questions;
		}else{

			$this->getMessage("Fetching questions from DB didnt work!");
			return 0;
		}
	}


	public function getQuestionInfoFromDatabase($sent_question_id){
        global $database;
        
        $sql = "SELECT * from questions WHERE question_id = '$sent_question_id' LIMIT 1";
        $resultSet = $database->query($sql);
        
        $result = $database->numRows($resultSet);

        if($result){
                
            $this->getMessage("getQuestionInfoFromDatabase function worked fine");

            $fetchedQuestion = $resultSet->fetch_assoc();

            $this->question_id = $fetchedQuestion['question_id'];
            $this->question_title = $fetchedQuestion['question_title'];
            $this->question_body = $fetchedQuestion['question_body'];
            $this->question_owner = $fetchedQuestion['question_owner'];
            $this->dateOfCreation = $fetchedQuestion['dateOfCreation'];
            $this->category = $fetchedQuestion['category'];

        }else{
            $this->getMessage("getQuestionInfoFromDatabase didnt work");
        }  
        
    }


    public function checkIfQuestionIsExist($sent_question_id){
    	global $database;
    	$this->getMessage("Im in the checkIfQuestionIsExist");
    	$sql = "SELECT * FROM questions WHERE question_id = '$sent_question_id' LIMIT 1";
    	$resultSet = $database->query($sql);
    	$result = $database->numRows($resultSet);
    	if($result){
    		$this->getMessage("the question is exists");
    		return 1;
    	}else{
    		$this->getMessage("the question is not exists");
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
