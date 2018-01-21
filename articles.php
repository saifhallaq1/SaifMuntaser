
<?php

require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Article.php';

session_start();


if($_SESSION['logged_in'] != 1){
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location: error.php");
}else{

    //$newUser = new User;
    //$username = $_SESSION['username'];
    //$email = $_SESSION['email'];
    $viewArticles = new Article;

    $articles = $viewArticles->getAllArticles();
    if($articles){
        // view articles
    }else{
        //$_SESSION['message'] = "error in the articles page!";
        //header("Location: error.php");
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

    <title>Profile Page</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/scrolling.css" rel="stylesheet">
    <!-- font awesome -->
    <link href="css/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote-bs4.js"></script>


</head>

<body class="modified-text">


<?php
include_once("header.php")
?>


<div class="myarticleimage">
    <img src="img/Untitled.jpg" class="image-responsive">
</div>

<!-- Main Content -->


<div class="container-fluid">
    <div class="row">


        <div class="col-md-9">

            <div class="col-md-12">
                <div class="filter" style="margin-top: 15px;padding-left: 330px;">
          <span style="font-size:35px;">Please select the Category : <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelect">
                <option selected style="font-size:20px;"> Choose...</option>
                <option value="1">Information Techology</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select></span></div>
                <hr>


                <?php
                foreach($articles as $name) {
                    $article_owner = new User;
                    $article_owner->getUserInfoFromDatabase($name['article_owner']);
                    ?>
                    <div class="post-preview">
                        <div class="row">

                            <div class="col-md-2 course-img" >
                                <img src="img/15356507_1364357016940040_4438434916611401275_n.jpg" class="rounded-circle" style="margin-left:25px; margin-bottom: 5px;height: 150px; width: 150px;"  >
                                <?php echo  '<div class="text-center" style="font-size: 25px;padding-left: 20px;" ><a id="111" href="viewProfile.php?user_id='. $article_owner->getUser_id() .'">'. $article_owner->getUsername() . '</a></div>';?>
                                <div class="course-stars card-stars1 text-center" style="padding-left: 20px;">
                                    <div class="review-block-rate" >

                                        <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                        <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                        <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                        <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                        <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                    </div>
                                </div>


                            </div>

                            <div class="col-md-9">
                                <?php
                                $articledescription= strip_tags($name['article_body']);
                                echo '<a href="articlePage.php?article_id='. $name['article_id'] .'">
                                <h2 class="post-title bold articlefontH">'
                                    . $name['article_title'].
                                    '</h2>

                                <h3 class="post-subtitle articlefont">'
                                    .substr("$articledescription",0, 250).
                                    '</h3>
                            </a>'

                                ?>


                                <h6 class="card-subtitle mb-2 text-muted" style="margin-top: 20px;">Tags: <span class="badge badge-primary">PHP</span></h6><div class=" text-muted float-right" style="padding-left: 20px;"><?= $name['dateOfCreation'];?></div>

                                <div class="articlebutton ">
                                    <button type="button" class="btn btn-primary"><?php echo '<a href="articlePage.php?article_id='. $name['article_id'] .'">View Article</a>'; ?></button>
                                </div>

                            </div>


                        </div>
                    </div>
                    <Br>
                <?php } ?>
                <hr>

            </div>
            <ul class="pagination justify-content-center mb-4">
                <li class="page-item">
                    <a class="page-link" href="#">&larr; Older</a>
                </li>
                <li class="page-item disabled">
                    <a class="page-link" href="#">Newer</a>
                </li>
            </ul>
        </div>
        <div class="col-md-2 articleimage">
            <div class="position-fixed ">

                <div class="container">
                    <div class="img">
                        <img src="img/icon-articles.png" style="padding-bottom: 10px;">
                    </div>

                    <a href="post_article.php"> <button type="button" class="btn btn-danger" style="margin-left: 35px;"> Write an Article</button></a>

                </div>
            </div>
        </div>


        <hr>
        <!-- Pager -->

    </div>
</div>



<br>

<!-- Footer -->
<?php
include_once("Footer.php");
?>
</body>
</html>