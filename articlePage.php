
<?php 
//
require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Article.php';
require_once 'classes/Category.php';
require_once 'classes/Comment_Article.php';

session_start();


if($_SESSION['logged_in'] != 1){
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location: error.php");
}else{

    //$newUser = new User;
    //$username = $_SESSION['username'];
    //$email = $_SESSION['email'];
    $viewArticle = new Article;

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {   

        if ( isset($_GET['article_id']) && !empty($_GET['article_id'])) {
            
            

            $viewArticle->getArticleInfoFromDatabase($_GET['article_id']);

            $article_owner = new User;
            $article_owner->getUserInfoFromDatabase($viewArticle->getArticle_owner());

            $getCommentsArticle = new Comment_Article;
            $comments_article = $getCommentsArticle->fetchCommentOfArticle($_GET['article_id']);
            if($comments_article != 0){
                // comment has been fetched successfully
            }else{
                // somthing wrong happened
            }


        }else{
            header("location: articles.php"); 
        }
    }else{
        //go back to the articles page
        header("Location: articles.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Question and Answer</title>

    <?php
    include_once("header.php");
    ?>

</head>

<body class="modified-text">

<?php
include_once("header1.php");
?>

<!-- Navigation -->



<div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-8">
                        <div class="ArticleTitle">
                            <h1> <?php echo $viewArticle->getArticle_title(); ?></h1>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="votes float-right">
                            <?php echo $viewArticle->getDateOfCreation(); ?>
                        </div>
                    </div>
                </div>

                <div class="Article-body">
                    <?php echo $viewArticle->getArticle_body(); ?>
                    <div class="votes float-right">
                          0<i class="fa fa-thumbs-o-down " aria-hidden="true"> </i>
                          0<i class="fa fa-thumbs-o-up " aria-hidden="true"></i>
                      </div>
                   <hr>
                </div>

            </div>

            <div class="col-md-3 col-sm-1">
                <div class="conatiner">
                    <br>
                    <div class="card relatedarticles">
                        <div class="card-header">
                            Related Articles
                        </div>
                        <div class="card-body">
                            <ul>
                               <li><a href="#">Link</a> </li>
                                <li><a href="#">Link</a> </li>
                                <li><a href="#">Link</a> </li>
                                <li><a href="#">Link</a> </li>
                                <li><a href="#">Link</a> </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 </div>


<?php
foreach($comments_article as $name) { 
    $comment_owner = new User;
    $comment_owner->getUserInfoFromDatabase($name['comment_owner']);
?>
    <div class="container">
         <div class="row">

         <div class="media">
             <div class="row">
                 <div class="col-md-4">
                    <div class="profileimage">
                    <img class="d-flex align-self-center mr-3" style="height: 80px;width: 80px;" src="img/articleimage.png" alt="Sample photo">
                    </div>
                    <div class="usernam1">
                        <?= $comment_owner->getUsername(); ?>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="med float-right">
                        <p id="commentparagraph"><?= $name['comment_text']; ?></p>
                        <div class="creationofcomment float-right text-muted">
                        Posted on Time <?= $name['dateOfCreation']; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php   } ?>

<div class="container commentscontainer">

<h1> Post a comment</h1>
    <form action="postCommentforArticle.php" method="GET">
        <div class="form-group row">
           <div class="col-md-1">
               Comments:
           </div>
            <div class="col-md-11">
                <textarea rows="3" cols="90" name="comment_text" id="textareacomments1"></textarea>
            </div>

            <div class="col-md-11">
            <input type="hidden" name="article_id" value="<?php echo $_GET['article_id']; ?>"/>
            </div>

            <div class="col-md-11">
            <input type="Submit" name="postComment" value="Submit" class="btn btn-primary"/>
            </div>
        </div>
    </form>
</div>





<!-- Footer -->
<footer class="py-5 bg-dark myfooter">
    <div class="container">
        <p class="m-0 text-center text-white">LEEO</p>
    </div>


</body>
</html>