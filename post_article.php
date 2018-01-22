
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
    $viewCategories = new Category;
    $categories = $viewCategories->getCategories();
    if($categories != 0){
        //add the categories in the drop down list
    }else{
        //$_SESSION['message'] = "You must log in before viewing your profile page!";
        //header("location: error.php");
    }

    //$newUser = new User;
    //$username = $_SESSION['username'];
    //$email = $_SESSION['email'];


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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote-bs4.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- JavaScript -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote-bs4.js"></script>
</head>

<body id="profile-body" class="modified-text">


<!-- Navigation -->

<?php
include_once("header.php"); ?>

<div class="myarticleimage">
    <img src="img/Untitled.jpg" class="image-responsive">
</div>
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <form action="postArticle.php" method="GET" id="programmer_form">
                <div class="form-group row">
                    <label for="ArticleTitle"  class="col-2 col-form-label">Article Title:</label>
                    <div class="col-10">
                        <input class="form-control" type="text" name="article_title">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Category" class="col-2 col-form-label"> Category:</label>

                    <div class="dropdown col-10">

                        <select class="custom-select" name="category">
                            <?php
                            foreach($categories as $name) { ?>
                                <option value="<?= $name['category_title'] ?>"><?= $name['category_title'] ?></option>
                                <?php
                            } ?>--+














































                            0--














                        </select>

                    </div>
                </div>






        </div>
    </div>


    <textarea id="summernote" name="article_body"></textarea>

    <br>

    <input type="submit" name="submit" class="btn btn-primary">


</div>
<br>
</form>


</div>
</div>


<!-- Footer -->



<footer class="py-5 bg-dark myfooter">
    <div class="container-fluid footerdiv">
        <div class="row">

            <div class="col-md-6" id="footerlist">
                <h2 class="footerlist1" >About us</h2>
                <p class="footerlist" >Our aim is to give the students the opportunity to educate each other around the universities in Jordan

                    A New Way to Teach and Learn ! Either you were a student or tutor! Give what u have and earn money!</p>
            </div>


            <div class="col-md-2">

                <h2 class="footerlist1">Contact Us</h2>

                <i class="fa fa-facebook-square footerlist fa-2x" style="color: white; aria-hidden="true"><span style="font-size:20px; color:white; vertical-align: middle;"> Facebook.com/LEEO</span></i> <br>


                <i class="fa fa-envelope fa-2x"style="color: white;" aria-hidden="true"><span style="font-size:20px; color:white; vertical-align: middle;"> support@LEEO.com</span></i><br>
                <i class="fa fa-phone-square fa-2x" style="color: white;aria-hidden="true"> <span style="font-size:20px; color:white; vertical-align: middle;"> 0799999999</span></i>


            </div>


            <div class="col-md-2">

                <h2 class="footerlist1">Site Map</h2>

                <ul class="footerlist">
                    <li><a href="" class="footerlist"><i class="fa fa-search"></i> Find</a></li>

                    <li><a href="" class="footerlist"><i class="fa fa-book"></i> Atricle</a></li>
                    <li><a href="" class="footerlist"><i class="fa fa-question"></i> Q&A</a></li>
                    <li><a href="" class="footerlist"><i class="fa fa-phone"></i> Contact Us</a></li>

                </ul>


            </div>


        </div>
    </div>
</footer>



</body>

</html>
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