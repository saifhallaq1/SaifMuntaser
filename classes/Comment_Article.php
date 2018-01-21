<?php

class Comment_Article{

	protected $comment_id;
	protected $comment_text;
	protected $comment_owner;
	protected $article;
	protected $dateOfCreation;




	public function getComment_id(){
		return $this->comment_id;
	}

	public function setComment_text($comment_text){
		$this->comment_text = $comment_text;
	}

	public function getComment_text(){
		return $this->comment_text;
	}

	public function getComment_owner(){
		return $this->comment_owner;
	}

	public function getArticle(){
		return $this->article;
	}

	public function setDateOfCreation($dateOfCreation){
		$this->dateOfCreation = $dateOfCreation;
	}
	public function getDateOfCreation(){
		$this->dateOfCreation;
	}

	public function postComment($sent_comment_text, $sent_comment_owner, $sent_article_id){
		global $database;

		$this->getMessage(" I am in the postComment function");

		$date = date('Y-m-d H:i:s');
        $final = strtotime($date);
        $dateOfCreation1 = date('Y-m-d H:i:s', $final);
       
       	$sql = "INSERT INTO comments_article(comment_text, comment_owner, article, dateOfCreation) VALUES('$sent_comment_text', '$sent_comment_owner','$sent_article_id' , '$dateOfCreation1')";

        $resultSet = $database->query($sql);

        if($database->affectedRows($resultSet)){
        	$this->getMessage("Comment was posted");
 			return 1;
        }else{
        	$this->getMessage("Comment was not posted");
        	return 0;
        }
	}

	public function fetchCommentOfArticle($sent_article_id){
		global $database;

		$sql = "SELECT * FROM comments_article WHERE article = '$sent_article_id' ";

		$resultSet = $database->query($sql);

		$result = $database->numRows($resultSet);
		if ($result) {
			$this->getMessage("comments have been fetched from DB!");
			$comments = array();

			while($row = $resultSet->fetch_assoc()){
				
			  	// add each row returned into an array
			  	$comments[] = $row;
			}
			return $comments;
		}else{

			$this->getMessage("Fetching Comment from DB didnt work!");
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