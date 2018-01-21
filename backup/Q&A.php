<?php

require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Question.php';
require_once 'classes/Answer.php';
require_once 'classes/Category.php';
require_once 'classes/Comment_Answer.php';
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

    <title>Tutoring Class</title>

    <?php
    include_once("header1.php")
    ?>

</head>
</head>

<body class="modified-text">
<!-- Navigation -->

<!-- Navigation -->

<?php
include_once('header.php');

?>
<!-- Page Content -->
<div class="container-fluid container-fluid1" id="firstColumQA">

    <div class="row" id="rowQA">
        <div class="col-md-3 category-edited">
            <div class="category1">
                <div class="category2 ">Category</div>
            </div>
            <div class="single category">
                <script type="text/javascript">
                    setTimeout(function(){ showUser("AllCategories"); },1000);
                </script>
                <form>
                  <select name="categorylist" onchange="showUser(this.value)">
                    <option value="AllCategories" selected >All Categories</option>
                    <?php
                        foreach($categories as $categoryRow) {   
                    ?>
                        <option value="<?= $categoryRow['category_title']; ?>"><?= $categoryRow['category_title']; ?></option>
                    <?php
                       
                         }
                    ?>
                  </select>
                </form>
            </div>
        </div>
        <!-- Question&Answer Header -->
        <div class="col-md-6">


            <h1 class="my-6">Question and Answers(Q&A)<br>
                <small>LEEO.Social Question and Answer Community</small>
            </h1>
            <hr>
            <br>
            <!-- question list -->
            <div id="txtHint"></div>

            <!-- Blog Post -->








            <!-- Pagination -->
            <ul class="pagination justify-content-center mb-4">
                <li class="page-item">
                    <a class="page-link" href="#">&larr; Older</a>
                </li>
                <li class="page-item disabled">
                    <a class="page-link" href="#">Newer &rarr;</a>
                </li>
            </ul>

        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-3 ">

            <!-- Search Widget -->


            <!-- Categories Widget -->
            <button class="btn btn-danger questionbutton" style="width: 300px"  type="button"  data-toggle="modal" data-target="#myModal"><i>Ask a Question</i><i class="fa fa-question fa-lg" aria-hidden="true"></i> </button></h5>






            <!-- Side Widget -->
            <div class="card my-4 articlecard">
                <h5 class="card-header text-center">Articles</h5>
                <div class="card-body">
                    <a href="#">link1</a><br>
                    <a href="#">link2</a><br>
                    <a href="#">link3</a><br>
                    <a href="#">link4</a><br>
                    <a href="#">link5</a><br>
                </div>
            </div>

        </div>

    </div>
    <!-- /.row -->

</div>

<!-- Trigger the modal with a button -->


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title float-left"><i class="fa fa-pencil-square-o" aria-hidden="true">Ask a question</i></h4>
            </div>
            <div class="modal-body">
                <div class="container">

                    <form action="postQuestion.php" method="GET" >

                        <div class="form-group">
                            <label for="exampleTextarea">Question Title:</label>
                            <textarea class="form-control" id="questiondescription" rows="2" name="question_title"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleSelect1">Question category:</label>
                            <select class="form-control" name="category" id="exampleSelect1">
                                <?php
                                foreach($categories as $categoryR) {   
                                ?>
                                <option value="<?= $categoryR['category_id']; ?>"><?= $categoryR['category_title']; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleTextarea">Question Body:</label>
                            <textarea class="form-control" id="questiondescription" name="question_body" rows="5"></textarea>
                        </div>

                        <div class="form-group">
                        <input class="form-control" type="submit" name="submit" value="Post Question">                                                 
                        </div>

                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div

        <!-- Modal -->
<div id="myModal1" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title float-left"><i class="fa fa-pencil-square-o" aria-hidden="true">Ask a question</i></h4>
            </div>
            <div class="modal-body">
                <div class="container">

                    <form>
                        <div class="form-group">
                            <label for="exampleSelect1">Question Type</label>
                            <select class="form-control" id="exampleSelect1">
                                <option>Courses</option>
                                <option>University</option>
                                <option>Others</option>


                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleTextarea">Example textarea</label>
                            <textarea class="form-control" id="questiondescription" rows="5"></textarea>
                        </div>
                </div>    </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


    <?php

    include('Footer.php');
    ?>

    <script type="text/javascript">
         $('.button').click(function() {

         $.ajax({
          type: "POST",
          url: "some.php",
          data: { name: "John" }
        }).done(function( msg ) {
          alert( "Data Saved: " + msg );
        });    

    });

    </script>

    <script>
        function showUser(str) {
            if (str == "") {
                document.getElementById("txtHint").innerHTML = "<div align='center'><h2>Sorry! There is no Questions.</h2></div>";
                return;
            } else {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET","getQuestions.php?categoryt="+str,true);
                xmlhttp.send();
            }
        }
    </script>
</body>
</html>
