<?php 
/* Reset your password form, sends reset.php password link */
require_once 'includes/messages.php';
require_once 'classes/Database.php';
require_once 'classes/User.php';
session_start();

// Check if form submitted with method="post"
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) 
{   
  $forgotUser = new User;
  $safeEmail = $forgotUser->sanitize($_POST['email']);

  if($forgotUser->checkIfUserIsExistForForgotPassword($safeEmail)){

    $email = $forgotUser->getEmail();
    $hash = $forgotUser->getHash();
    $username = $forgotUser->getUsername();

    // Session message to display on success.php
    $_SESSION['message'] = "<p>Please check your email <span>$email</span>"
    . " for a confirmation link to complete your password reset!</p>";

    // Send registration confirmation link (reset.php)
    $to      = $email;
    $subject = 'Password Reset Link';
    $message_body = '
    Hello '.$username.',

    You have requested password reset!

    Please click this link to reset your password:

    http://localhost/project/reset.php?email='.$email.'&hash='.$hash;  

    mail($to, $subject, $message_body);

    header("location: success.php");
  }else{
    $_SESSION['message'] = "User with that email doesn't exist!";
    header("location: error.php");
  }
}else{
   // header("location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Reset Your Password</title>
  <link href="csss/style.css" rel="stylesheet">
  <?php //include 'csss/style.css'; ?>
</head>

<body>
    
  <div class="form">

    <h1>Reset Your Password</h1>

    <form action="forgot.php" method="post">
     <div class="field-wrap">
      <label>
        Email Address<span class="req">*</span>
      </label>
      <input type="email"required autocomplete="off" name="email"/>
    </div>
    <button class="button button-block"/>Reset</button>
    </form>
  </div>
          
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>
</body>

</html>
