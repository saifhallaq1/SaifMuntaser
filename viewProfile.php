
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
            header("location: error.php");
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

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/scrolling-nav.css" rel="stylesheet">
    <!-- font awesome -->
    <link href="css/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">


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

<br>
<br>
<br>

<div class="container">
    <div class="row profile">
        <div class="col-md-3">
            <div class="profile-sidebar">
                <div class="profile-userpic">
                    <img src="http://guarddome.com/assets/images/profile-img.jpg" alt="not working" class="img-fluid rounded-circle">

                </div>
                <div class="profile-user-title">
                    <div class="profile-username">
                        <?php echo $username;?>
                    </div>


                </div>
                <div class="profile-use-menu">
<br>
                    <ul class="nav">
                        <li class="active"><a href=""><i class="fa fa-address-card" aria-hidden="true">Overview</i></a></li>

                    </ul>
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

            <h3><b><center>About</center></b></h3><br>


            <?php echo $about; ?>

<br>
            <br>

            <div class="jumbotron ">

                <div class="row">
                    <div class="col-md-6">
                        <h3><i class="fa fa-venus-mars" aria-hidden="true"><b> Gender</b></i></h3>

                        <div class="Gender">
                            <?php echo $gender; ?>
                        </div>


                    </div>

                    <div class="col-md-6">
                        <h3><i class="fa fa-bolt" aria-hidden="true"><b> Degree</b></i></h3>

                        <div class="degree">
                            <?php echo $degree; ?>
                        </div>


                    </div>



                </div>

                <br>





                <div class="row">
                    <div class="col-md-6">
                        <h3><i class="fa fa-birthday-cake" aria-hidden="true"><b> Age</b></i></h3>

                        <div class="Age">
                            <?php echo $DOB; ?>
                        </div>


                    </div>

                    <div class="col-md-6">
                        <h3><i class="fa fa-university" aria-hidden="true"><b> University</b></i></h3>

                        <div class="university">
                            <?php echo $university; ?>
                        </div>


                    </div>



                </div>

<br>


                <div class="row">
                    <div class="col-md-6">

                        <h3><i class="fa fa-book" aria-hidden="true"><b> Offered Courses</h3></i>

                        <div class="courses">

                            <i class="fa fa-check" aria-hidden="true"> Calculus</i><br>

                            <i class="fa fa-check" aria-hidden="true"> German</i><br>
                            <i class="fa fa-check" aria-hidden="true"> Arabic</i>


                        </div>


                    </div>

                   <div class="col-md-6">

                       <div class="hobbies">
                       <h3><i class="fa fa-futbol-o" aria-hidden="true"><b>Hobbies</b></i></h3>

                       <?php echo $hobbies; ?>


                       </div>
                   </div>


                </div>

                    </div>

            <h3><center><b> Reviews</b></center></h3>
            <div class="row">
                <div class="col-md-12">
                    <hr/>
                    <div class="review-block">
                        <div class="row" >
                            <div class="col-sm-3">
                                <img src="http://dummyimage.com/60x60/666/ffffff&text=No+Image" class="img-rounded">
                                <div class="review-block-name"><a href="#">Muntaser Mraisi</a></div>
                                <div class="review-block-date">January 29, 2016<br/>1 day ago</div>
                            </div>
                            <div class="col-sm-9">
                                <div class="review-block-rate">
                                    <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                                        <span class="fa fa-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                                        <span class="fa fa-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-xs" aria-label="Left Align">
                                        <span class="fa fa-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
                                        <span class="fa fa-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-xs" aria-label="Left Align">
                                        <span class="fa fa-star" aria-hidden="true"></span>
                                    </button>
                                </div>
                                <div class="review-block-title">this was nice in buy</div>
                                <div class="review-block-description"> he is really good at teaching i would take another classes with him again</div>
                            </div>
                        </div>
                        <hr/>
        </div>
    </div>
</div>

                </div>


        <div class="col-md-1">


        </div>




</div>

</div>







<!-- Footer -->
<footer class="py-5 bg-dark myfooter">
    <div class="container">
        <p class="m-0 text-center text-white">LEEO</p>
    </div>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">


</body>

</html>
