<?php
/**
 * Created by PhpStorm.
 * User: Muntaser
 * Date: 1/19/2018
 * Time: 2:01 AM
 */

class Lecture
{
    protected $lecture_id;
    protected $lecture_title;
    protected $lecture_description;
    protected $lecture_date_time;
    protected $lecture_location;
    protected $group_id;

    public function getLecture_id(){
        return $this->lecture_id;
    }

    public function getLecture_title(){
        return $this->lecture_title;
    }

    /**
     * @param mixed $lecture_title
     */
    public function setLecture_title($lecture_title)
    {
        $this->lecture_title = $lecture_title;
    }

    /**
     * @return mixed
     */
    public function getLecture_description()
    {
        return $this->lecture_description;
    }

    /**
     * @param mixed $lecture_description
     */
    public function setLecture_description($lecture_description)
    {
        $this->lecture_description = $lecture_description;
    }

    /**
     * @return mixed
     */
    public function getLecture_date_time()
    {
        return $this->lecture_date_time;
    }

    /**
     * @param mixed $lecture_date_time
     */
    public function setLecture_date_time($lecture_date_time)
    {
        $this->lecture_date_time = $lecture_date_time;
    }

    /**
     * @return mixed
     */
    public function getLecture_location()
    {
        return $this->lecture_location;
    }

    /**
     * @param mixed $lecture_location
     */
    public function setLecture_location($lecture_location)
    {
        $this->lecture_location = $lecture_location;
    }

    /**
     * @return mixed
     */
    public function getGroup_id()
    {
        return $this->group_id;
    }


    public function addLecture($sent_lecture_title, $sent_lecture_description, $sent_lecture_date_time, $sent_lecture_location, $sent_group_id){

        global $database;

        $this->getMessage("we are in the addLecture function");


        //$final = strtotime($sent_lecture_date_time);
        //$adjusted_date__time = date('Y-m-d H:i:s', $final);

        // $combinedDT = date('Y-m-d H:i:s', strtotime("$sent_scheduled_date $sent_time"));

        $sql = "INSERT INTO lectures(lecture_title, lecture_description, lecture_date_time, lecture_location, group_id) VALUES ('$sent_lecture_title', '$sent_lecture_description', '$sent_lecture_date_time', '$sent_lecture_location', '$sent_group_id')";



        $resultSet = $database->query($sql);
        if ($resultSet) {
            if ($database->affectedRows()) {
                $this->getLectureInfoFromDatabase($database->last_id());
                return 1;
            } else {
                return 0;
            }
        }
    }


    public function getLectureInfoFromDatabase($sent_lecture_id){
        global $database;

        $sql = "SELECT * FROM lectures WHERE group_id = '$sent_lecture_id' LIMIT 1";
        $resultSet = $database->query($sql);

        $result = $database->numRows($resultSet);

        if($result){

            $this->getMessage("getLectureInfoFromDatabase function worked fine");

            $fetchedLecture = $resultSet->fetch_assoc();

            $this->lecture_id = $fetchedLecture['lecture_id'];
            $this->lecture_title = $fetchedLecture['lecture_title'];
            $this->lecture_date_time = $fetchedLecture['lecture_date_time'];
            $this->lecture_description = $fetchedLecture['lecture_description'];
            $this->lecture_location = $fetchedLecture['lecture_location'];
            $this->group_id = $fetchedLecture['group_id'];
        }else{
            $this->getMessage("getLectureInfoFromDatabase didn't work");
        }

    }



    public function getLecturesByGroup($sent_group_id){
        global $database;

        $sql = "SELECT * FROM lectures WHERE group_id = '$sent_group_id' ";

        $resultSet = $database->query($sql);
        $result = $database->numRows($resultSet);
        if($result){
            $this->getMessage("lectures have been fetched from DB!");
            $lectures = array();

            while($row = $resultSet->fetch_assoc()){

                // add each row returned into an array
                $lectures[] = $row;
            }
            return $lectures;
        }else{

            $this->getMessage("Fetching lectures from DB didn't work!");
            return 0;
        }
    }


    public function updateLectureInfo($sent_lecture_id)
    {
        global $database;

        $sql = "SELECT * from lectures WHERE lecture_id = '$sent_lecture_id' LIMIT 1";
        $resultSet = $database->query($sql);

        $result = $database->numRows($resultSet);

        if($result){

            $sql1 = "UPDATE lectures SET lecture_title = '$this->lecture_title', lecture_description = '$this->lecture_description', lecture_date_time = '$this->lecture_date_time', lecture_location = '$this->lecture_location' WHERE lecture_id = '$sent_lecture_id' ";
            $resultSet1 = $database->query($sql1);
            if ($resultSet1) {
                if ($database->affectedRows()) {

                    $this->getMessage("updateLectureInfo function worked fine");
                    return 1;
                } else {

                    $this->getMessage("updateLectureInfo	 function didn't work!");
                    return 0;
                }
            }

        }else{
            $this->getMessage("updateLectureInfo didnt work");
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