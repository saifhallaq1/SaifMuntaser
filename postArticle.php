
<?php 

require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Article.php';
require_once 'classes/Category.php';
session_start();


if($_SESSION['logged_in'] != 1){
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location: error.php");
}else{

    //$newUser = new User;
    //$username = $_SESSION['username'];
    //$email = $_SESSION['email'];

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {   

        if ( isset($_GET['article_title']) && !empty($_GET['article_title']) && isset($_GET['category']) && !empty($_GET['category']) && isset($_GET['article_body']) && !empty($_GET['article_body'])) {
            
            $newArticle = new Article;
            $safeArticle_title = $newArticle->sanitize($_GET['article_title']);
            $safeCategory = $newArticle->sanitize($_GET['category']);
            $safeArticle_body = $newArticle->sanitize($_GET['article_body']);

            $getCategory = new Category;
            $getCategory->getCategoryInfoFromDatabase($safeCategory);

            if($newArticle->addArticle($safeArticle_title, $safeArticle_body, $_SESSION['user_id'], $getCategory->getCategory_id())){

                header("Location: articlePage.php?article_id=".$newArticle->getArticle_id());
                
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