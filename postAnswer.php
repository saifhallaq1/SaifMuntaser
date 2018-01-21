
<?php 

require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Answer.php';
session_start();


if($_SESSION['logged_in'] != 1){
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location: error.php");
}else{

    //$newUser = new User;
    //$username = $_SESSION['username'];
    //$email = $_SESSION['email'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if ( isset($_POST['answer_text']) && !empty($_POST['answer_text']) && isset($_POST['question_id']) && !empty($_POST['question_id']) && isset($_POST['user_id']) && !empty($_POST['user_id'])) {
            
            $newAnswer= new Answer;
            $safeAnswer_text = $newAnswer->sanitize($_POST['answer_text']);
            $safeQuestion_id = $newAnswer->sanitize($_POST['question_id']);
            $userId = $_POST['user_id'];

            if($newAnswer->addAnswer($safeAnswer_text, $userId, $safeQuestion_id)){

                header("Location: Q&A.php");
                
            }else{
         
               header("Location: Q&A.php"); 
            }

        }else{
        	header("Location: Q&A.php"); 
        }
    }else{
    	header("Location: Q&A.php");
    }
}

?>