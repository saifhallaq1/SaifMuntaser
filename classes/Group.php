<?php 


class Group 
{
	
	protected $group_id;
	protected $tutor;
	protected $group_title;
	protected $group_description;
	protected $group_learning_outcomes;
	protected $status;
	protected $scheduled_date_time;
	protected $hourly_rate;
	protected $numberOfStudents;
	protected $number_of_lectures;
	protected $dateOfCreation;
	protected $category;


	public function getGroup_id(){
		return $this->group_id;
	}

	public function getTutor(){
		return $this->tutor;
	}

	public function getGroup_title(){
		return $this->group_title;
	}

	public function setGroup_title($group_title){
		$this->group_title = $group_title;
	}


	public function getGroup_description(){
		return $this->group_description;
	}

	public function setGroup_description($group_description){
		$this->group_description = $group_description;
	}

	public function getGroup_learning_outcomes(){
		return $this->group_learning_outcomes;
	}

	public function setGroup_learning_outcomes($group_learning_outcomes){
		$this->group_learning_outcomes = $group_learning_outcomes;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}

	public function getScheduled_date_time(){
		return $this->scheduled_date_time;
	}

	public function setScheduled_date_time($scheduled_date_time){
		$this->scheduled_date_time = $scheduled_date_time;
	}

	public function getHourly_rate(){
		return $this->hourly_rate;	
	}

	public function setHourly_rate($hourly_rate){
		$this->hourly_rate = $hourly_rate;
	}
	public function getNumberOfStudents(){
		return $this->numberOfStudents;
	}

	public function setNumberOfStudents($numberOfStudents){
		$this->numberOfStudents = $numberOfStudents;
	}

	public function getNumber_of_lectures(){
		return $this->number_of_lectures;
	}

	public function setNumber_of_lectures($number_of_lectures){
		$this->number_of_lectures = $number_of_lectures;
	}

	public function getDateOfCreation(){
		return $this->dateOfCreation;
	}

	public function setDateOfCreation($dateOfCreation){
		$this->dateOfCreation = $dateOfCreation;
	}

	public function getCategory(){
		return $this->category;
	}

	public function setCategory($category){
		$this->category = $category;
	}


	public function addGroup($sent_tutor, $sent_group_title, $sent_group_description, $sent_group_learning_outcomes, $sent_status, $sent_scheduled_date, $sent_time, $sent_hourly_rate, $sent_numberOfStudents, $sent_number_of_lectures, $sent_category){

		global $database;

		$this->getMessage("we are in the addGroup function");

		$date = date('Y-m-d H:i:s');
        $final = strtotime($date);
        $dateOfCreation1 = date('Y-m-d H:i:s', $final);

        $combinedDT = date('Y-m-d H:i:s', strtotime("$sent_scheduled_date $sent_time"));
        
		$sql = "INSERT INTO groups(tutor, group_title, group_description, group_learning_outcomes, status, scheduled_date_time ,hourly_rate, numberOfStudents, number_of_lectures, dateOfCreation, category) VALUES ('$sent_tutor', '$sent_group_title', '$sent_group_description', '$sent_group_learning_outcomes', '$sent_status', '$combinedDT', '$sent_hourly_rate', '$sent_numberOfStudents', $sent_number_of_lectures, '$dateOfCreation1', '$sent_category')";

		

		$resultSet = $database->query($sql);
		if($database->affectedRows()){
			$this->getGroupInfoFromDatabase($database->last_id());
			return 1;
		}else{
			return 0;
		}
	}

	
	public function getGroupInfoFromDatabase($sent_group_id){
        global $database;
        
        $sql = "SELECT * FROM groups WHERE group_id = '$sent_group_id' LIMIT 1";
        $resultSet = $database->query($sql);
        
        $result = $database->numRows($resultSet);

        if($result){
                
            $this->getMessage("getGroupInfoFromDatabase function worked fine");

            $fetchedGroup = $resultSet->fetch_assoc();

            $this->group_id = $fetchedGroup['group_id'];
            $this->tutor = $fetchedGroup['tutor'];
            $this->group_title = $fetchedGroup['group_title'];
            $this->group_description = $fetchedGroup['group_description'];
            $this->group_learning_outcomes = $fetchedGroup['group_learning_outcomes'];
        	$this->status = $fetchedGroup['status'];
            $this->scheduled_date_time = $fetchedGroup['scheduled_date_time'];
            $this->hourly_rate = $fetchedGroup['hourly_rate'];
            $this->numberOfStudents = $fetchedGroup['numberOfStudents'];
            $this->number_of_lectures = $fetchedGroup['number_of_lectures'];
            $this->dateOfCreation = $fetchedGroup['dateOfCreation'];
            $this->category = $fetchedGroup['category'];

        }else{
            $this->getMessage("getGroupInfoFromDatabase didn't work");
        }  
        
    }

    public function updateStatus($sent_status, $sent_group_id){
	    global $database;
        $sql= "UPDATE groups SET status = '$sent_status' WHERE group_id = '$sent_group_id' ";
	    $resultSet = $database->query($sql);
		if($database->affectedRows()){
		    $this->getMessage("status has been updated");
		    return true;
        }else{
            $this->getMessage("status has not been updated");
		    return false;
        }
    }

    public function getAllGroups(){
		global $database;

		$sql = "SELECT * FROM groups";

		$resultSet = $database->query($sql);
		$result = $database->numRows($resultSet);
		if($result){
			$this->getMessage("groups have been fetched from DB!");
			$groups = array();

			while($row = $resultSet->fetch_assoc()){
				
			  	// add each row returned into an array
			  	$groups[] = $row;
			}
			return $groups;
		}else{
			$this->getMessage("Fetching groups from DB didnt work!");
			return 0;
		}
	}

    public function getGroupsByCategory($sent_category_id){
        global $database;

        $sql = "SELECT * FROM groups WHERE category = '$sent_category_id' ";

        $resultSet = $database->query($sql);
        $result = $database->numRows($resultSet);
        if($result){
            $this->getMessage("Groups have been fetched from DB!");
            $groups = array();

            while($row = $resultSet->fetch_assoc()){

                // add each row returned into an array
                $groups[] = $row;
            }
            return $groups;
        }else{

            $this->getMessage("Fetching groups from DB didnt work!");
            return 0;
        }
    }

    public function sendRateAndReviewEmailToStudents($sent_student_username, $sent_student_id,$sent_student_email,$sent_tutor_gender,$sent_tutor_username){
        // Send rate and review link (reviewRate.php)
        $to      = $sent_student_email;
        $subject = 'Comment and rate '.$sent_tutor_gender.''.$sent_tutor_username;
        $message_body = '
        Hello '.$sent_student_username.',

        Thank you for using LEEO!

        Please click this link to rate and comment the tutor and the '.$this->getGroup_title().' course:

        http://localhost/project/loginRR.php?user='.$sent_student_id.'&group='.$this->getGroup_id();

        mail( $to, $subject, $message_body );
    }

	public function updateGroupInfo($sent_group_id)
     {
        global $database;

        $sql = "SELECT * from groups WHERE group_id = '$sent_group_id' LIMIT 1";
        $resultSet = $database->query($sql);
        
        $result = $database->numRows($resultSet);

        if($result){

            $sql1 = "UPDATE groups SET group_title = '$this->group_title', group_description = '$this->group_description', group_learning_outcomes = '$this->group_learning_outcomes', hourly_rate = '$this->hourly_rate', scheduled_date_time = '$this->scheduled_date_time', numberOfStudents = '$this->numberOfStudents', number_of_lectures = '$this->number_of_lectures', category = '$this->category' WHERE group_id = '$sent_group_id' ";
            $resultSet1 = $database->query($sql1);

            if($database->affectedRows()){

                $this->getMessage("updateGroupInfo function worked fine");
                return 1;
            }else{

                $this->getMessage("updateGroupInfo	 function didn't work!");
                return 0;
            }

        }else{
            $this->getMessage("updateGroupInfo didnt work");
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