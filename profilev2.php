
<?php

require_once 'classes/Database.php';
require_once 'classes/User.php';
session_start();


if($_SESSION['logged_in'] != 1){
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location: error.php");
}else{

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        if ( isset($_GET['user_id']) && !empty($_GET['user_id'])) {
            if($_GET['user_id'] == $_SESSION['user_id']){
                // give user more permissions to edit hi peofile
                $viewUser = new User;
                $viewUser->getUserInfoFromDatabase($_GET['user_id']);
                $username = $_SESSION['username'];
                $email = $_SESSION['email'];
                $phone = $viewUser->getPhone();
                $university  = $viewUser->getUniversity();
                $gender = $viewUser->getGender();
                $degree = $viewUser->getDegree();
                $DOB = $viewUser->getDOB();
                $hobbies = $viewUser->getHobbies();
                $about = $viewUser->getAbout();

            }else{
                // this section is only to view any user profile.
                $viewUser = new User;
                $viewUser->getUserInfoFromDatabase($_GET['user_id']);
                $username = $viewUser->getUsername();
                $email = $viewUser->getEmail();
                $phone = $viewUser->getPhone();
                $university  = $viewUser->getUniversity();
                $gender = $viewUser->getGender();
                $degree = $viewUser->getDegree();
                $DOB = $viewUser->getDOB();
                $hobbies = $viewUser->getHobbies();
                $about = $viewUser->getAbout();
            }


        }else{
            header("Location: error.php");
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
    include_once('header1.php');

    ?>


</head>

<body>

<?php
include_once('header.php');

?>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                      <div class="profile-picture-row">

                          <div class="profile-picture">

                              <img src="../project/img/15356507_1364357016940040_4438434916611401275_n.jpg" alt="not working" class="img-fluid ">

                          </div>
                           <hr>

                          <div class="edit-button">

                              <input type="button" class="btn btn-danger" value="Edit Profile Settings" style="padding-right: 20px;margin-left: 70px;margin-bottom: 20px">

                          </div>


                          <div class="profile-info">


                              <div class="padding-info">

                                  <span id="Age"><i class="fa fa-birthday-cake modifi" aria-hidden="true"> <?php echo $DOB; ?></i></span>

                              </div>

                              <div class="padding-info">

                                  <span id="Gender"><i class="fa fa-venus-mars" aria-hidden="true"> Male</i></span>

                              </div>

                              <div class="padding-info">

                                <i class="fa fa-bolt" aria-hidden="true"><?php echo $degree; ?>   Degree</i>

                              </div>

                              <div class="padding-info">

                                  <i class="fa fa-phone" aria-hidden="true"><?php echo $phone; ?> </i>

                              </div>


                              <div class="padding-info">

                                  <span id="uni">  <i class="fa fa-university" aria-hidden="true"> <?php echo $university; ?></i></span>

                              </div>

                          </div>

                      </div>
                    </div>

                    <div class="col-md-8">

                        <div class="username1">
                            <br>
                            <div class="row">


                                <div class="col-md-6">

                            <i class="fa fa-user-circle fa-2x"  aria-hidden="true"> <span style="font-family: 'Open Sans', sans-serif;"> <?php echo $username;?></span></i>
                                </div>

                                <div class="col-md-6">

                                    <div class="course-stars card-stars1">
                                        <div class="review-block-rate float-right">

                                            <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                            <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                            <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                            <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                            <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                        </div></div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">

                                    <span id="lastseen"><i class="fa fa-spinner"  aria-hidden="true"> <span style="font-family: 'Open Sans', sans-serif;">Last seen: 12/12/2012</i></span>

                                </div>

                                <div class="col-md-6">

                                    <span id="lastseen"><i class="fa fa-check"  aria-hidden="true"> <span style="font-family: 'Open Sans', sans-serif;">Member since: 14/12/2014</i></span>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-12 tagsbox">
                                <div class="tags">

                                    <h3 class="text-muted modified-text"> Tags:</h3>
                                    <h5 class="modified-text"><span class="badge badge-primary ">Caculus</span>
                                    <span class="badge badge-primary">PHP</span>
                                    <span class="badge badge-primary">Java</span>
                                        <span class="badge badge-primary">English</span></h5>
                                </div>
                                </div>
                            </div>

                        </div>
<hr>

                        <h2  class="modified-text"><center>About Me</center></h2>
                        <hr>
                        <div class="about profilebox">
                        <p>   <?php echo $about; ?> </p>
                        </div>

<br>
                        <h2 class="modified-text"><center>Reviews</center></h2>
                        <hr>
                        <div class="row review-block101" >
                            <div class="col-sm-3">
                                <img src="http://dummyimage.com/60x60/666/ffffff&text=No+Image" class="img-rounded">
                                <div class="review-block-name modified-text"><a href="#">Muntaser Mraisi</a></div>
                                <div class="review-block-date modified-text">January 29, 2016<br/>1 day ago</div>
                            </div>
                            <div class="col-sm-9">
                                <div class="course-stars card-stars1">
                                    <div class="review-block-rate float-right">

                                        <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                        <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                        <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                        <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                        <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                    </div></div>
                                <div class="review-block-title modified-text">this was nice in buy</div>
                                <div class="review-block-description modified-text"> he is really good at teaching i would take another classes with him again</div>
                            </div>
                        </div>
                        </div>
                </div>
            </div>



























































<br>

<?php

include("Footer.php");
?>





</body>
</html>