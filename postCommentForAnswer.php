
<?php

require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Comment_Answer.php';
session_start();


if($_SESSION['logged_in'] != 1){
    $_SESSION['message'] = "You must log in!";
    header("location: error.php");
}else{

    //$newUser = new User;
    //$username = $_SESSION['username'];
    //$email = $_SESSION['email'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if ( isset($_POST['comment_text']) && !empty($_POST['comment_text']) && isset($_POST['answer_id']) && !empty($_POST['answer_id']) && isset($_POST['user_id']) && !empty($_POST['user_id'])) {

            $newComment_answer= new Comment_Answer;
            $safeComment_text = $newComment_answer->sanitize($_POST['comment_text']);
            $safeAnswer_id = $newComment_answer->sanitize($_POST['answer_id']);
            $userId = $_POST['user_id'];

            if($newComment_answer->postComment($safeComment_text, $userId, $safeAnswer_id)){

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