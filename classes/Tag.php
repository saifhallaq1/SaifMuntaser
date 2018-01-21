<?php 

class Tag{
	
	protected $tag_id;
	protected $tag_text;

	public function getTag_id(){
		return $this->tag_id;
	}

	public function getTag_text(){
		return $this->tag_text;
	}



    public function addTag($sent_tag_text){
        global $database;

        $sql = "INSERT INTO tags (tag_text) VALUES('$sent_tag_text') ";

        $resultSet = $database->query($sql);
        if ($database->affectedRows($resultSet)){
            $this->getTagInfoFromDatabaseById($database->last_id());
            $this->getMessage("tag has been added ".$sent_tag_text);
            return 1;
        }else{
            $this->getMessage("tag didnt add ".$sent_tag_text);
            return 0;
        }
    }



    public function checkTagIfExist($sent_tag_text){
        global $database;
        $sql = "SELECT * FROM tags WHERE tag_text LIKE '$sent_tag_text'";

        $resultSet = $database->query($sql);
        $result = $database->numRows($resultSet);
        if ($result){
            $this->getMessage("tag is exist ".$sent_tag_text);
            return $result;
        }else{
            $this->getMessage("tag isn't exist ".$sent_tag_text);
            return 0;
        }
    }


    public function getTagInfoFromDatabaseByText($sent_tag_text){
        global $database;

        $sql = "SELECT * from tags WHERE tag_text LIKE '$sent_tag_text' LIMIT 1";
        $resultSet = $database->query($sql);

        $result = $database->numRows($resultSet);

        if($result){

            $this->getMessage("getTagInfoFromDatabaseByText function worked fine");

            $fetchedTag = $resultSet->fetch_assoc();

            $this->tag_id = $fetchedTag['tag_id'];
            $this->tag_text = $fetchedTag['tag_text'];


        }else{
            $this->getMessage("getTagInfoFromDatabaseByText didnt work");
        }

    }

    public function getTagInfoFromDatabaseById($sent_tag_id){
        global $database;

        $sql = "SELECT * from tags WHERE tag_id = '$sent_tag_id' LIMIT 1";
        $resultSet = $database->query($sql);

        $result = $database->numRows($resultSet);

        if($result){

            $this->getMessage("getTagInfoFromDatabaseById function worked fine");

            $fetchedTag = $resultSet->fetch_assoc();

            $this->tag_id = $fetchedTag['tag_id'];
            $this->tag_text = $fetchedTag['tag_text'];


        }else{
            $this->getMessage("getTagInfoFromDatabaseById didnt work");
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