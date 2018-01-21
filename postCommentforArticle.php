
<?php 

require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Article.php';
require_once 'classes/Comment_Article.php';
session_start();


if($_SESSION['logged_in'] != 1){
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location: error.php");
}else{

    $newUser = new User;
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {   

        if ( isset($_GET['comment_text']) && !empty($_GET['comment_text']) && isset($_GET['article_id']) && !empty($_GET['article_id'])) {
            
            $newArticle = new Article;
            if($newArticle->checkIfArticleIsExist($_GET['article_id'])){

                $postComment_article = new Comment_Article;
                $safeComment_text = $postComment_article->sanitize($_GET['comment_text']);
                if($postComment_article->postComment($safeComment_text, $_SESSION['user_id'], $_GET['article_id'])){
                    header("Location: articlePage.php?article_id=".$_GET['article_id']);
                }else{
                    header("Location: articles.php");
                }
            }else{
                header("Location: articles.php");
            }
        }else{
        	header("Location: articles.php");
        }
    }else{
    	//go back to the articles page
    	header("Location: articles.php");
    }
}

?>