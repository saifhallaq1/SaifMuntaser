<?php

require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Question.php';
require_once 'classes/Answer.php';
require_once 'classes/Category.php';
require_once 'classes/Comment_Answer.php';


	if(isset($_GET['query']) && !empty($_GET['query'])){


		$sql = "SELECT tag_text FROM tags WHERE tag_text LIKE '%".$_GET['query']."%' LIMIT 10";
		$result = $database->query($sql);
		$json = [];

		while($row = $result->fetch_assoc()){

		     $json[] = $row['tag_text'];

		}


		echo json_encode($json);


	}else{
		$json = [];
		$json[] = 'alkshf';
		$json[] = 'alksafsnnsafhf';
		$json[] = 'alksfaslkfnsahf';
		echo json_encode($json);
	}
	

?>