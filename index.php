<?php 
require_once 'includes/messages.php';
require_once 'classes/Database.php';
require_once 'classes/User.php';
//require_once 'includes/init.php';

session_start();
// check if user is logged in
if(isset($_SESSION)){
   // header("Location: home.php");
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
      include_once("header1.php");
      ?>

    
        <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){


           if(isset($_POST['login'])) {

           require_once 'controllers/login.php';

          }elseif (isset($_POST['register'])) {
            require_once 'controllers/register.php';
          }

        }


        ?>
        
  </head>

  <body id="page-top">

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
              <a class="nav-link" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#loginModal" href="#">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <section id="Find">
    <div class="jumbotron myjumbotron text-white">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="display-3">Welcome to LEEO!</h1>
            <p class="lead">Our aim is to give the students the opportunity to educate each other around the universities in Jordan</p>

            <p>A New Way to Teach and Learn ! Either you were a student or tutor! Give what u have and earn money!</p>
            <p class="lead">
              <a class="btn btn-primary btn-lg" href="#" role="button">Offer a Tutor Class</a> <a class="btn btn-danger btn-lg" href="#" role="button">Look for a Tutor Class</a>
            </p>
          </div>
        </div>
      </div>
    </div>

   <!-- <header class="bg-primary text-white">
      <div class="container text-center">
        <h1>Welcome to Scrolling Nav</h1>
        <p class="lead">A landing page template freshly redesigned for Bootstrap 4</p>
      </div>
    </header>
-->
    <section id="QandA">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 mx-auto questionandanswer">
            <img src="/new project/img/question.png" id="questionimage" class="rounded float-left" alt="myimg">
          </div>

            <div class="col-lg-7 mx-auto">

            <h2>Question and Answers(Q&A)</h2>
            <p class="lead">LEEO.Social Question and Answer Community</p>
            <ul>
              <li>Ask questions and get free answers from expert tutors</li>
              <li>Responsive behavior when clicking nav links perfect for a one page website</li>
              <li>Bootstrap's scrollspy feature which highlights which section of the page you're on in the navbar</li>
              <li>Minimal custom CSS so you are free to explore your own unique design options</li>
            </ul>
          </div>
          <div class="col-lg-2 mx-auto">

            <a class="btn btn-primary btn-lg" href="#" id="QandAbtn"role="button">Ask a question</a>

          </div>

        </div>
      </div>
    </section>

    <section id="Articles" class="bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 mx-auto questionandanswer">
            <img src="/new project/img/articleimage.png" id="Articleimage" class="rounded float-left" alt="myimg">
          </div>
          <div class="col-lg-7 mx-auto">
            <h2>Articles</h2>
            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut optio velit inventore, expedita quo laboriosam possimus ea consequatur vitae, doloribus consequuntur ex. Nemo assumenda laborum vel, labore ut velit dignissimos.</p>
          </div>

        <div class="col-lg-2 mx-auto">

          <a class="btn btn-primary btn-lg" href="#" id="QandAbtn"role="button">Post an Article</a>
        </div>
        </div>
      </div>
    </div>
    </section>

    <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 mx-auto questionandanswer">
            <img src="/new project/img/contact.png" id="contact" class="rounded float-left" alt="myimg">
          </div>
          <div class="col-lg-7 mx-auto">
            <h2>Contact us</h2>
            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero odio fugiat voluptatem dolor, provident officiis, id iusto! Obcaecati incidunt, qui nihil beatae magnam et repudiandae ipsa exercitationem, in, quo totam.</p>
          </div>
          <div class="col-lg-2 mx-auto">

            <a class="btn btn-primary btn-lg" href="#" id="QandAbtn"role="button">Contact Us</a>
          </div>
        </div>
      </div>
    </section>






      <div class="modal fade login" id="loginModal">
        <div class="modal-dialog login animated">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Login with</h4>
            </div>
            <div class="modal-body">
              <div class="box">
                <div class="content">

                  <div class="division">

                    <div class="line r"></div>
                  </div>
                  <div class="error"></div>

                  <div class="form loginBox">
                    <form method="post" action="index.php" accept-charset="UTF-8">
                      <input id="email" class="form-control" type="text" placeholder="Username or Email" name="usernameOrEmail">
                      <input id="password" class="form-control" type="password" placeholder="Password" name="password">
                      <p class="forgot"><a href="forgot.php">Forgot Password?</a></p>
                      <input class="btn btn-default btn-login" type="submit" value="Login" name="login">

    
                    </form>
                  </div>
                </div>
              </div>
              <div class="box">
                <div class="content registerBox" style="display:none;">
                  <div class="form">


                    <form method="post" html="{:multipart=>true}" data-remote="true" action="index.php" accept-charset="UTF-8">
                      <input id="username" class="form-control" type="text" placeholder="Username" name="username">
                      <input id="email" class="form-control" type="text" placeholder="Email" name="email">
                      <input id="firstname" class="form-control" type="text" placeholder="First name" name="firstname">
                      <input id="lastname" class="form-control" type="text" placeholder="Last name" name="lastname">
                      <input id="password" class="form-control" type="password" placeholder="Password" name="password">
                      <input id="password_confirmation" class="form-control" type="password" placeholder="Repeat Password" name="password_confirmation">
                      <select type="gender" name="gender" placeholder="Gender" class="form-control">
                        <option value="female">Female</option>
                        <option value="male">Male</option>
                      </select>

                      <input class="btn btn-default btn-register" type="submit" value="Create account" name="register">
                      

                    </form>


            </div>
          </div>
        </div>
            </div>
            <div class="modal-footer">
              <div class="forgot login-footer">
                            <span>Looking to
                                 <a href="javascript: showRegisterForm();">create an account</a>
                            ?</span>
              </div>
              <div class="forgot register-footer" style="display:none">
                <span>Already have an account?</span>
                <a href="javascript: showLoginForm();">Login</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>

        <?php
        include_once ("../project/Footer.php");
        ?>


        <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom JavaScript for this theme -->
    <script src="js/scrolling-nav.js"></script>

  </body>

</html>
