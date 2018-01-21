<?php 
Class Student{

	protected $student_group_id;
	protected $group_id;
	protected $student_id;
	protected $rate_group;

	public function getStudent_group_id(){
		return $this->student_group_id;
	}

	public function getGroup_id(){
		return $this->group_id;
	}

	public function getStudent_id(){
		return $this->student_id;
	}

    public function getRateGroup()
    {
        return $this->rate_group;
    }

	public function addStudentInGroup($sent_group_id, $sent_student_id){
		global $database;

		$sql = "INSERT INTO students(group_id, student_id) VALUES ('$sent_group_id','$sent_student_id')";
		$resultSet = $database->query($sql);
		if($database->affectedRows($resultSet)){
			return 1;
		}else{
			return false;
		}
	}

	public function checkStudentIsExist($sent_group_id, $sent_student_id){
	    global $database;
        $this->getMessage("student is exist".$sent_group_id." ".$sent_student_id);
	    $sql = "SELECT * FROM students WHERE group_id = '$sent_group_id' AND student_id = '$sent_student_id' ";
	    $resultSet = $database->query($sql);


        $result = $database->numRows($resultSet);
        if ($result) {
            $this->getMessage("student is exist");
            return 1;
        } else {
            $this->getMessage("student is not exist");
            return 0;
        }

    }


    public function getStudentsByGroupId($sent_group_id){
        global $database;

        $sql = "SELECT * FROM students WHERE group_id = '$sent_group_id' ";

        $resultSet = $database->query($sql);
        $result = $database->numRows($resultSet);
        if($result){
            $this->getMessage("students have been fetched from DB!");
            $students = array();

            while($row = $resultSet->fetch_assoc()){

                // add each row returned into an array
                $students[] = $row;
            }
            return $students;
        }else{
            $this->getMessage("Fetching students from DB didnt work!");
            return 0;
        }
    }

	public function removeStudentFromGroup($sent_group_id, $sent_student_id){
		global $database;

		$sql = "DELETE FROM students WHERE group_id = '$sent_group_id' AND student_id = '$sent_student_id' ";
		$resultSet = $database->query($sql);
		if($database->affectedRows()){
			return 1;
		}else{
			return 0;
		}


	}

    public function setStudentHasRatedGroup($sent_student_id, $sent_group_id){
	    global $database;
	    $rG = 1;
	    $sql = "UPDATE students SET rate_group = '$rg' WHERE student_id = '$sent_student_id' AND group_id = '$sent_group_id' ";
	    $resultSet = $database->query($sql);

	    if ($database->affectedRows()){
	        return true;
        }else{
	        return false;
        }
    }

	public function getStudentInfoFromDatabase($sent_student_group_id){
        global $database;
        
        $sql = "SELECT * from students WHERE student_group_id = '$sent_student_group_id' LIMIT 1";
        $resultSet = $database->query($sql);
        
        $result = $database->numRows($resultSet);

        if($result){
                
            $this->getMessage("getStudentInfoFromDatabase function worked fine");

            $fetchedStudent = $resultSet->fetch_assoc();

            $this->student_group_id = $fetchedStudent['student_group_id'];
            $this->group_id = $fetchedStudent['group_id'];
            $this->student_id = $fetchedStudent['student_id'];
            $this->rate_group = $fetchedStudent['rate_group'];
            

        }else{
            $this->getMessage("getStudentInfoFromDatabase didnt work");
        }  
        
    }


    protected function getMessage($msg){
        echo "
            <script>
                alert('$msg');
            </script>
        ";
    }
}


?>