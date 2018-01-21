<?php

/**
*  
*/
class Article_Tags
{
	protected $a_t_id;
	protected $article_id;
	protected $tag_id;

	public function getA_t_id(){
		return $this->a_t_id;
	}

	public function getArticle_id(){
		return $this->article_id;
	}

	public function getTag_id(){
		return $this->tag_id;
	}
	
	//gets user info from the database
    public function getRowsByArticleId($sent_article_id){
        global $database;
        
        $sql = "SELECT * from articles_tags WHERE article = '$sent_article_id'";
        $resultSet = $database->query($sql);
        
        $result = $database->numRows($resultSet);

        if($result){
                
            
			$this->getMessage("getRowsByArticleId function worked!");
			$articlesTags = array();

			while($row = $resultSet->fetch_assoc()){
				
			  	// add each row returned into an array
			  	$articlesTags[] = $row;

			}
			return $articlesTags;


        }else{
            $this->getMessage("getRowsByArticleId didnt work");
        }  
        
    }


    public function getRowsByTagId($sent_tag_id){
        global $database;
        
        $sql = "SELECT * from articles_tags WHERE tag = '$sent_tag_id'";
        $resultSet = $database->query($sql);
        
        $result = $database->numRows($resultSet);

        if($result){
                
            
			$this->getMessage("getRowsByTagId function worked!");
			$articlesTags = array();

			while($row = $resultSet->fetch_assoc()){
				
			  	// add each row returned into an array
			  	$articlesTags[] = $row;

			}
			return $articlesTags;


        }else{
            $this->getMessage("getRowsByTagId didnt work");
        }  
        
    }


    public function addTag($sent_tag_id, $sent_article_id){
    	global $database;

    	$sql = "INSERT INTO articles_tags(article, tag) VALUES('$sent_article_id', '$sent_tag_id')";

    	$resultSet = $database->query($sql);

    	if($database->affectedRows($resultSet)){
    		return 1;
    	}else{
    		return 0;
    	}
    }
	
}


?>