
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
    <link href="css/scrolling-nav.css" rel="stylesheet">
    <!-- font awesome -->
    <link href="css/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote-bs4.js"></script>


</head>

<body id="profile-body">







<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav1">


    <div class="container">

        <a class="navbar-brand " href="#page-top">Lets Educate Each Other</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span></button>


        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link " href="#Home">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " href="#Find">Find</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#Q&A">Q&A</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#Articles">Articles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#contact">contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ModalLoginForm" href="#">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Page Header -->
<header class="masthead">
    <img src="img/Untitled.jpg" class="img-fluid">
</header>

<!-- Main Content -->

<div class="row">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
        <div class="col-lg-8 col-md-10 mx-auto">


            <hr>

            <?php
                foreach($articles as $name) { 
                    $article_owner = new User;
                    $article_owner->getUserInfoFromDatabase($name['article_owner']);
                    ?>
                <div class="post-preview">
                    <div class="row">

                        <div class="col-md-3 course-img" >
                            <img src="img/Logo.png" class="img-rounded" style="width: 120px;" style="height: 120px;" >
                         <?php echo  '<div class="course-block-name" ><a id="111" href="viewProfile.php?user_id='. $article_owner->getUser_id() .'">'. $article_owner->getUsername() . '</a></div>';?>
                            <div class="course-stars card-stars1">
                                <div class="review-block-rate">

                                    <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                    <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                    <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                    <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                    <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                </div>
                            </div>

                            <div class="course-block-date"><?= $name['dateOfCreation'];?></div>
                        </div>

                        <div class="col-md-9">

                           <?php 
                            echo '<a href="articlePage.php?article_id='. $name['article_id'] .'">
                                <h2 class="post-title">'
                                    . $name['article_title'].
                                '</h2>

                                <h3 class="post-subtitle">'
                                    .$name['article_body'].
                                '</h3>
                            </a>';

                            ?>


                            <h6 class="card-subtitle mb-2 text-muted">Tags: <span class="badge badge-primary">PHP</span></h6>
                            <div class="thumbsup float-right">
                                $0<i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                $0<i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                            </div>
                            <div class="articlebutton">
                                <?php echo '<a href="articlePage.php?article_id='. $name['article_id'] .'">View Article</a>'; ?>
                            </div>

                        </div>


                    </div>
                </div>
                <Br>
                <?php } ?>         
            <hr>

        </div>

    </div>

        <div class="col-md-3 articleimage">
            <div class="container articlecontainer1">
        <img src="img/icon-articles.png"><br>
            <button type="button" class="btn btn-danger"> Write an Article</button>
        </div>

    </div>

            <hr>
            <!-- Pager -->

    </div>
</div>
</div>


           <br>
             <!--<h2> Insert your Article:</h2>
            <div id="summernote"></div>
            <script>
                $('#summernote').summernote({
                    placeholder: 'Write your article here.',
                    tabsize: 2,
                    height: 100,
                    toolbar: [
                        // [groupName, [list of button]]
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        ['table', ['table']]
                    ]
                });
            </script>
            <br>

        <button type="button" class="btn btn-primary"> Submit</button>


        </div>
    </div>
</div>


<hr>
<!-- Footer -->
<footer class="py-5 bg-dark myfooter">
    <div class="container">
        <p class="m-0 text-center text-white">LEEO</p>
    </div>
</body>
</html>