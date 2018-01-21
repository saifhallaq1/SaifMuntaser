<?php

require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Group.php';
require_once 'classes/Category.php';
session_start();


if($_SESSION['logged_in'] != 1){
    $_SESSION['message'] = "You must log in!";
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



}
?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home</title>

    <?php
    include_once("header1.php")
    ?>


</head>



<body id="page-top">

<!-- Navigation -->

<?php
include_once('header.php');

?>

<div class="container">

    <form action="postGroup.php" method="GET">
    <div class="row row1">
        <div class="col-md-9">
            <div class="form-group coursetitle">
                <label for="Title">Course Title</label>
                <input type="text" name="group_title" class="form-control" id="CourseTitle"  placeholder="Insert Your Course Title">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="Title">Price Per Hour (JD)</label>
                <input type="number" name="hourly_rate" class="form-control" id="PPH" min="0"  placeholder="Price Here" >
            </div>
        </div>
    </div>


    <div class="row row1">
        <div class="col-md-9">
            <div class="form-group">
                <label for="Title">Tags</label>
                <input type="text" class="form-control" id="Tags" name="tags"  placeholder="Insert Your Tags Here">
            </div>


        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="Title">N. Of Students (Capacity)</label>
                <input type="number" name="numberOfStudents" class="form-control" id="PPH" min="0" placeholder="Price Here" >
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="Title">Number of Lectures</label>
                <input type="number" onchange="showUser(this.value)" name="number_of_lectures" class="form-control" id="PPH" min="0" placeholder="" >
            </div>
        </div>

    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="exampleSelect1">Question category</label>
            <select class="form-control" id="exampleSelect1" name="category">
                <?php
                foreach($categories as $categoryR) {
                    ?>
                    <option value="<?= $categoryR['category_id']; ?>"><?= $categoryR['category_title']; ?></option>
                    <?php
                }
                ?>

            </select>
        </div>
    </div>

        <div class="row" id="txtHint"></div>

    <div class="row row1">


            <div class="col-md-5">
                <div class="form-group">
                    <label for="Date">Schedule Date</label>
                    <input class="form-control"  id="date" type="date" min="<?= date("Y/m/d"); ?>" name="scheduled_date">

                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="time">Time</label>
                    <input class="form-control" id="date" type="time" name="time">

                </div>
            </div>

        </div>




        <div class="row row1">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="Title"><center>Course Description</center></label>
                    <textarea class="form-control" id="CourseDescription" placeholder="Insert Your Description Here " name="group_description"></textarea>
                </div>
            </div>
        </div>

        <div class="row row1">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="Title"><center>learning outcomes</center></label>
                    <textarea class="form-control" id="CourseDescription" placeholder="Insert Your learning outcomes Here " name="group_learning_outcomes"></textarea>
                </div>
            </div>
        </div>

        <input type="submit" name="submit" value="Create Tutoring Class" class="btn btn-primary submitbutton">

    
</form>


</div>
<?php

include_once("footer.php");
?>

</body>

<script type="text/javascript">
    $('#Tags').tagsInput();
</script>

<script>
    function showUser(str) {
        if (str == "") {
            document.getElementById("txtHint").innerHTML = "<div align='center'><h2>Sorry! There is no Tutoring Classes.</h2></div>";
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
            xmlhttp.open("GET","getLecturesForm.php?number_of_lectures="+str,true);
            xmlhttp.send();
        }
    }
</script>
</html>