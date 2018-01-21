<?php 

class Category{

	protected $category_id;
	protected $category_title;


	public function getCategory_id(){
		return $this->category_id;
	}

	public function setCategory_title($category_title){
		$this->category_title = $category_title;
	}

	public function getCategory_title(){
		return $this->category_title;
	}


	public function getCategories(){
		global $database;

		$sql = "SELECT * FROM categories";

		$resultSet = $database->query($sql);

		$result = $database->numRows($resultSet); 

		if($result){
			$this->getMessage("Categories have been fetched from DB!");
			$categores = array();

			while($row = $resultSet->fetch_assoc()){
				
			  	// add each row returned into an array
			  	$categores[] = $row;

			}
			return $categores;
		}else{

			$this->getMessage("Fetching categores from DB didnt work!");
			return 0;
		}
	}

	public function getCategoryInfoFromDatabase($sent_Category_title){
        global $database;
        
        $sql = "SELECT * from categories WHERE category_title = '$sent_Category_title' LIMIT 1";
        $resultSet = $database->query($sql);
        
        $result = $database->numRows($resultSet);

        if($result){
                
            $this->getMessage("getCategoryInfo function worked fine");

            $fetchedCategory = $resultSet->fetch_assoc();

            $this->category_id = $fetchedCategory['category_id'];
            $this->category_title = $fetchedCategory['category_title'];
            
            return 1;
        }else{
            $this->getMessage("getCategoryInfo didnt work");
            return 0;
        }  
        
    }

    public function getCategoryInfoFromDatabaseById($sent_Category_id){
        global $database;

        $sql = "SELECT * FROM categories WHERE category_id = '$sent_Category_id' LIMIT 1";
        $resultSet = $database->query($sql);

        $result = $database->numRows($resultSet);

        if($result){

            $this->getMessage("getCategoryInfoFromDatabaseById function worked fine");

            $fetchedCategory = $resultSet->fetch_assoc();

            $this->category_id = $fetchedCategory['category_id'];
            $this->category_title = $fetchedCategory['category_title'];

            return 1;
        }else{
            $this->getMessage("getCategoryInfoFromDatabaseById didnt work");
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
}


?>