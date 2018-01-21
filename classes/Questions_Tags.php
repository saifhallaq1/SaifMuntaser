<?php
/**
 * Created by PhpStorm.
 * User: Muntaser
 * Date: 1/6/2018
 * Time: 12:55 AM
 */

class Questions_Tags
{
    protected $q_t_id;
    protected $question;
    protected $tag;

    /**
     * @return mixed
     */
    public function getQ_t_Id()
    {
        return $this->q_t_id;
    }

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }

    public function checkTagIfExist($sent_question, $sent_tag){
        global $database;
        $sql = "SELECT * FROM questions_tags WHERE question = '$sent_question' AND tag = '$sent_tag' ";

        $resultSet = $database->query($sql);
        $result = $database->numRows($resultSet);
        if ($result){
            $this->getMessage("tag is exist for question ");
            return $result;
        }else{
            $this->getMessage("tag isn't exist for question ");
            return 0;
        }
    }

    public function addTagForQuestion($sent_question, $sent_tag){
        global $database;

        $sql = "INSERT INTO questions_tags (question, tag) VALUES('$sent_question', '$sent_tag') ";

        $resultSet = $database->query($sql);
        if ($database->affectedRows($resultSet)){
            $this->getMessage("addTagForQuestion worked ".$sent_tag);
            return 1;
        }else{
            $this->getMessage("addTagForQuestion didnt work ".$sent_tag);
            return 0;
        }
    }

    public function getTagsByQuestion($sent_question){
        global $database;
        $sql = "SELECT * FROM questions_tags WHERE question = '$sent_question'";

        $resultSet = $database->query($sql);
        $result = $database->numRows($resultSet);
        if($result){
            $this->getMessage("tags have been fetched from DB for Questions!");
            $tags = array();

            while($row = $resultSet->fetch_assoc()){

                // add each row returned into an array
                $tags[] = $row;
            }
            return $tags;
        }else{

            $this->getMessage("getTagsByQuestion didnt fetch from DB for Questions!");
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