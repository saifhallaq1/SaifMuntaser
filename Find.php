
<?php 

require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Group.php';
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

    <title>Home</title>

    <?php
    include_once("header1.php")
    ?>


</head>



<body class="modified-text">

<!-- Navigation -->

<?php
include_once('header.php');

?>

            <div class="container-fluid findContiner">
                <div class="content" style="margin-left: 400px; padding-top: 100px; ">
                    <center><h1><b> <span style="color: white;margin-right: 500px;"> Find Your Tutoring Class</span></b></h1></center>
                    <p style="color: white; margin-left: 200px;"> You can Seach for your class either by typing its name or search it through category</p>
                    <div class="findbar">


                <div class="row ">

                    <div class="col-md-8" style="margin-top: 70px; margin-left: 10px">

                        <input id="searchinput"  value=" Search for Your Course"type="text">

                    </div>

                    <script type="text/javascript">
                        setTimeout(function(){ showUser("AllCategories"); },1000);
                    </script>

                    <div class="col-md-2" style="margin-top: 70px; margin-left: 10px; height: 100px;width: 100px;">
                        <select name="categorylist" onchange="showUser(this.value)" class="form-control form-control-lg" style="height: 60px; border-radius: 25px; width: 300px;">
                            <option value="AllCategories" selected >All Categories</option>
                            <?php
                            foreach($categories as $categoryRow) {
                                ?>
                                <option value="<?= $categoryRow['category_title']; ?>"><?= $categoryRow['category_title']; ?></option>
                                <?php

                            }
                            ?>
                        </select>
                    </div>

                </div>
                    </div>
                </div></div>
<br>
<div class="container-fluid" style="margin-left: 30px;margin-bottom: 20px;">
    <div class="row">
        <div class="col-md-2 findsidebar">
            <table id="myTable">
                <tr class="header">
                    <th >Name</th>
                </tr>
            </table>
        </div>

    <div class="col-md-7" id="txtHint" style="border: 1px grey; background-color: #f7f7f7; margin-bottom: 15px;">
        <!-- hon awaleeto -->



        <!-- hon akhreeto -->
    </div>
        <div class="col-md-2">
        <div class="position-fixed ">

            <div class="container">

                <button type="button" class="btn btn-danger" style="margin-left: 35px;"> Create A Class </button>

            </div>
        </div>
        </div>
    </div>
    </div>
<?php
include_once("footer.php")
?>









</body>
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
            xmlhttp.open("GET","getGroups.php?categoryt="+str,true);
            xmlhttp.send();
        }
    }
</script>
</html>