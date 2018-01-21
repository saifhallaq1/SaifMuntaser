<?php 
class Article{

	protected $article_id;
	protected $article_title;
	protected $article_body;
	protected $article_owner;
	protected $article_upvote;
	protected $article_downvote;
	protected $dateOfCreation;
	protected $category;

	public function getArticle_id(){
		return $this->article_id;
	}

	public function setArticle_title($article_title){
		$this->article_title = $article_title;
	}

	public function getArticle_title(){
		return $this->article_title;
	}

	public function setArticle_body($article_body){
		$this->article_body = $article_body;
	}

	public function getArticle_body(){
		return $this->article_body;
	}
	public function setArticle_owner($article_owner){
		$this->article_owner = $article_owner;
	}

	public function getArticle_owner(){
		return $this->article_owner;
	}

	public function setArticle_upvote($article_upvote){
		$this->article_upvote = $article_upvote;
	}

	public function getArticle_upvote(){
		return $this->article_upvote;
	}

	public function setArticle_downvote($article_downvote){
		$this->article_downvote = $article_downvote;
	}

	public function getArticle_downvote(){
		return $this->article_downvote;
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




	public function getAllArticles(){
		global $database;

		$sql = "SELECT * FROM articles";

		$resultSet = $database->query($sql);
		$result = $database->numRows($resultSet);
		if($result){
			$this->getMessage("Articles have been fetched from DB!");
			$articles = array();

			while($row = $resultSet->fetch_assoc()){
				
			  	// add each row returned into an array
			  	$articles[] = $row;
			}
			return $articles;
		}else{

			$this->getMessage("Fetching Articles from DB didnt work!");
			return 0;
		}
	}
	public function addArticle($sent_article_title, $sent_article_body, $sent_article_owner, $sent_category){
		global $database;

		$date = date('Y-m-d H:i:s');
        $final = strtotime($date);
        $dateOfCreation1 = date('Y-m-d H:i:s', $final);


       
       	$sql = "INSERT INTO articles(article_title, article_body, article_owner, dateOfCreation, category) VALUES('$sent_article_title', '$sent_article_body','$sent_article_owner' , '$dateOfCreation1', '$sent_category')";


        $resultSet = $database->query($sql);
        if($database->affectedRows($resultSet)){
        	if($database->last_id() != 0){

    		$this->getArticleInfoFromDatabase($database->last_id());

       		}
 			return 1;
        	
        }else{
        	return 0;
        }


	}

	public function getArticleInfoFromDatabase($sent_article_id){
        global $database;
        
        $sql = "SELECT * from articles WHERE article_id = '$sent_article_id' LIMIT 1";
        $resultSet = $database->query($sql);
        
        $result = $database->numRows($resultSet);

        if($result){
                
            $this->getMessage("getArticleInfo function worked fine");

            $fetchedArticle = $resultSet->fetch_assoc();

            $this->article_id = $fetchedArticle['article_id'];
            $this->article_title = $fetchedArticle['article_title'];
            $this->article_body = $fetchedArticle['article_body'];
            $this->article_owner = $fetchedArticle['article_owner'];
            $this->article_upvote = $fetchedArticle['article_upvote'];
            $this->article_downvote = $fetchedArticle['article_downvote'];
            $this->dateOfCreation = $fetchedArticle['dateOfCreation'];
            $this->category = $fetchedArticle['category'];
            


        }else{
            $this->getMessage("getArticleInfo didnt work");
        }  
        
    }

    public function checkIfArticleIsExist($sent_article_id){
    	global $database;
    	$this->getMessage("Im in the checkIfArticleIsExist");
    	$sql = "SELECT * FROM articles WHERE article_id = '$sent_article_id' LIMIT 1";
    	$resultSet = $database->query($sql);
    	$result = $database->numRows($resultSet);
    	if($result){
    		$this->getMessage("the Article is exists");
    		return 1;
    	}else{
    		$this->getMessage("the Article is not exists");
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