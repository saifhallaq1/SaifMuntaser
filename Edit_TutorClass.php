
<?php

require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Group.php';
require_once 'classes/Category.php';
require_once 'classes/Student.php';
require_once  'classes/Group_Tag.php';
require_once  'classes/Tag.php';

session_start();


if($_SESSION['logged_in'] != 1){
    $_SESSION['message'] = "You must log in!";
  header("location: error.php");
    
}else{
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['group_id']) && !empty($_GET['group_id'])){
            $getUser = new User;
            $getUser->getUserInfoFromDatabase($_SESSION['user_id']);
            $editGroup = new Group;
            $editGroup->getGroupInfoFromDatabase($_GET['group_id']);
            $group_tags = new Group_Tag;
            $group_tags_list = $group_tags->getTagsByGroupId($_GET['group_id']);

            $viewCategories = new Category;
            $categories = $viewCategories->getCategories();

            $getStudent = new Student;
            $students = $getStudent->getStudentsByGroupId($_GET['group_id']);

            //header("location: tutoringClass.php?group_id=".$_GET['group_id']);


        }else{
            header("location: home.php");
        }

    }else{
        header("location: home.php");
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

    <title>Tutoring Class</title>

    <?php
    include_once("header1.php")
    ?>

</head>

<body>


<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand " href="#page-top">Let's Educate Each Other</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">



                <li class="nav-item">
                    <a class="nav-link " href="Find.php">Find</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="Q&A.php">Q&A</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="article.php">Articles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="Contact.php">contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ModalLoginForm" href="#">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


</nav>


<div class="container">
    <form action="editGroup.php" method="GET">
    <div class="row">
        <div class="col-md-3">

            <div class="conatiner">
                <div class="card cardowner">
                    <div class="card-header">
                        Tutor
                    </div>

                    <img src="img/img_avatar1.png"  class="ownerimage rounded-circle">
                    <div class="card-body text-center">
                        <h4 class="card-title-1"><?= $getUser->getUsername(); ?></h4>
                    </div>
                    <div class="article-stars1 text-center">

                        <div class="review-block-rate">

                            <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                            <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                            <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                            <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                            <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                        </div></div>

                    <a href="viewProfile.php?user_id=<?= $getUser->getUser_id(); ?>" class="btn btn-primary">See Profile</a>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="jumbotron">
                <div class="container">
                    <div class="row ">
                        <div class="col-md-9 titlegroup  ">
                            <h1><input type="text" name="group_title" value="<?= $editGroup->getGroup_title(); ?>"></h1>

                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 RegandCapgroup Article-body1">
                            N.Of Students Reg.: <span class="badge badge-primary"><?php if(!empty($students)){ echo count($students);}else{echo 0;} ?></span>

                        </div>
                        <div class="col-md-6 Article-body1">
                            Capacity:<span class="badge badge-success"> <input type="number" name="capacity"  id="inputedit" min="<?php if(!empty($students)){ echo count($students);}else{echo 0;} ?>" value="<?= $editGroup->getNumberOfStudents(); ?>"></span>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 Article-body1">
                            Price Per Hour:<input type="number" name="hourly_rate" id="inputedit" value="<?= $editGroup->getHourly_rate(); ?>" >
                            <hr>
                        </div>

                        <div class="col-md-12 Article-body1">
                            Number of Lectures:<input type="number" name="number_of_lectures" id="inputedit" value="<?= $editGroup->getNumber_of_lectures(); ?>" >
                            <hr>
                        </div>

                    </div>
                    <!--- Lectures List -->

                    <script type="text/javascript">
                        setTimeout(function(){ showUser("<?= $editGroup->getGroup_id(); ?>"); },800);
                    </script>
                    <div id="txtHint"></div>

                    <!--- Lectures List -->


                    <div class="row">
                        <div>
                            Scheduled (date/time):<input type="date" name="scheduled_date" value="<?= date("Y-d-m", strtotime($editGroup->getScheduled_date_time())); ?>" > <input type="time" name="time" value="<?= date("h:m", strtotime($editGroup->getScheduled_date_time())); ?>" >
                            <hr>
                        </div>

                    </div>

                    <div class="row">
                        <div>
                            Tags:<input type="text" name="tags" id="input-tags" value="<?php if ($group_tags_list){foreach ($group_tags_list as $tagRow){
                                $getTag = new Tag;
                                $getTag->getTagInfoFromDatabaseById($tagRow['tag_id']);
                                echo $getTag->getTag_text().',';
                            }
                            } ?>" >
                            <hr>
                        </div>

                    </div>

                    <div class="row">
                        <div>
                            Category:<select class="form-control" name="category" id="exampleSelect1">
                                        <?php
                                        foreach($categories as $categoryR) {
                                            if($categoryR['category_id'] == $editGroup->getCategory()) {
                                                ?>
                                                <option selected="selected" value="<?= $categoryR['category_id']; ?>"><?= $categoryR['category_title']; ?></option>
                                                <?php
                                            }else{
                                                ?>
                                                <option value="<?= $categoryR['category_id']; ?>"><?= $categoryR['category_title']; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                            <hr>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="title">
                                <center>Learning Outcomes <i class="fa fa-crosshairs" aria-hidden="true"></i></center> </div>
                            <div class="Article-body1">
                                <textarea type="text" name="group_learning_outcomes" rows="5" cols="55"><?= $editGroup->getGroup_learning_outcomes(); ?></textarea>
                                <hr>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="group_id" value="<?= $editGroup->getGroup_id(); ?>">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="title">
                                <center>Description <i class="fa fa-search" aria-hidden="true"> </i></center></div>
                            <div class="Article-body1">
                                <textarea cols="55" name="group_description" onkeyup="textAreaAdjust(this)" style="overflow:hidden"><?= $editGroup->getGroup_description(); ?></textarea>
                            </div>
                            <input type="submit" name="submitGroup" class="btn btn-danger" style="margin-top: 30px; margin-left: 320px; padding-right: 40px;" value="Confirm">
                        </div>
                    </div>






                </div>

            </div>
        </div>
    </div>



</form>

</div>










<script>
    function textAreaAdjust(o) {
          o.style.height = "1px";
          o.style.height = (25+o.scrollHeight)+"px";
          }

</script>






</body>
<script type="text/javascript">
    $('#input-tags').tagsInput();
</script>


<script>
    function showUser(str) {
        if (str == "") {
            document.getElementById("txtHint").innerHTML = "<div align='center'><h2>There is no lectures.</h2></div>";
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
            xmlhttp.open("GET","getLecturesForEdit.php?group_id="+str+"&number_of_lectures=<?= $editGroup->getNumber_of_lectures(); ?>",true);
            xmlhttp.send();
        }
    }
</script>

</html>