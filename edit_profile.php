
<?php

require_once 'classes/Database.php';
require_once 'classes/User.php';
session_start();


if($_SESSION['logged_in'] != 1){
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location: error.php");

}else{
    $editUser = new User;
    $editUser->getUserInfoFromDatabase($_SESSION['user_id']);

    if($_SESSION['username'] != $editUser->getUsername()){
        $_SESSION['message'] = "somthing wrong happend in editing profile. Please try again!";
        header("location: error.php");
    }else{
        $username = $editUser->getUsername();
        $email = $_SESSION['email'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if ( isset($_POST['university']) && !empty($_POST['university'])) {
                $editUser->setUniversity($_POST['university']);
            }

            if (isset($_POST['hobbies']) && !empty($_POST['hobbies'])) {
                $editUser->setHobbies($_POST['hobbies']);
            }

            if (isset($_POST['phone']) && !empty($_POST['phone'])) {
                $editUser->setPhone($_POST['phone']);
            }

            if (isset($_POST['degree']) && !empty($_POST['degree'])) {
                $editUser->setdegree($_POST['degree']);
            }

            if (isset($_POST['about']) && !empty($_POST['about'])) {
                $editUser->setAbout($_POST['about']);
            }
            if (isset($_POST['DOB']) && !empty($_POST['DOB'])) {
                $editUser->setDOB($_POST['DOB']);
            }

            $editUser->updateUserInfo($_SESSION['user_id']);

            header("Location: viewProfile.php?user_id=".$_SESSION['user_id']);

        }


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

    <?php
    include_once ("header1.php")
    ?>

    <style>
        html{
            zoom: 80%;
        }
    </style>
</head>

<body>





<!-- Navigation -->
<?php
include_once('header.php')
?>




<div class="container" style="padding-top: 50px;">
    <div class="row profile">
        <div class="col-md-3">
            <div class="profile-sidebar">
                <div class="profile-userpic">
                    <img src="http://guarddome.com/assets/images/profile-img.jpg" alt="not working" class="img-fluid rounded-circle">

                </div>
                <div class="profile-user-title">
                    <div class="profile-username">
                        <?php echo $username; ?>
                    </div>


                </div>

                <div class="profile-use-menu">
                    <br>

                    <br>
                    <div class="jumbotron rating-block">
                        <h4>Average user rating</h4>
                        <h2 class="bold padding-bottom-7">4.3 <small>/ 5</small></h2>
                        <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                            <span class="fa fa-star" aria-hidden="true"></span>
                        </button>
                        <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                            <span class="fa fa-star" aria-hidden="true"></span>
                        </button>
                        <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                            <span class="fa fa-star" aria-hidden="true"></span>
                        </button>
                        <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                            <span class="fa fa-star" aria-hidden="true"></span>
                        </button>
                        <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                            <span class="fa fa-star" aria-hidden="true"></span>
                        </button>
                    </div>

                </div>
            </div>

        </div>


        <div class="col-md-8">

            <form action="edit_profile.php" method="POST">
                <div class="form-group row">
                    <label for="University" class="col-2 col-form-label">University</label>
                    <div class="col-10">
                        <input class="form-control" type="text" name="university">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-search-input" class="col-2 col-form-label">Fav hobby</label>
                    <div class="col-10">
                        <input class="form-control" type="text" name="hobbies"  >
                    </div>
                </div>


                <div class="form-group row">
                    <label for="example-tel-input" class="col-2 col-form-label">Telephone</label>
                    <div class="col-10">
                        <input class="form-control" type="tel" name="phone" id="example-tel-input">
                    </div>
                </div>

                <!-- tags -->
                <div class="form-group row">
                    <label for="example-tel-input" class="col-2 col-form-label">Tags</label>
                    <div class="col-10">
                        <input class="form-control" type="tag" name="tags" id="example-tel-input">
                    </div>
                </div>
                <!-- end of tags -->


                <div class="form-group row">
                    <label for="example-tel-input" class="col-2 col-form-label">Date of birth</label>
                    <div class="col-10">
                        <input class="form-control" type="date" name="DOB" id="example-tel-input">
                    </div>
                </div>

                <div class="form-inline ">
                    <label class="col-2 col-form-label">Degree</label>
                    <select class="form-control" name="degree">

                        <option value="Bachelor">Bachelor</option>
                        <option  value="Masters">Masters</option>
                        <option  value="PHD">PHD</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleTextarea">About</label>
                    <textarea class="form-control" id="exampleTextarea" rows="3" name="about"></textarea>
                </div>
                <button class="btn btn-primary">Submit</button>

        </div>
        </form>





    </div>


</div>


<div  style="margin-top: 100px; padding-left: -200px;">

    <?php
    include_once('Footer.php');
    ?>
</div>
</body>

</html>
