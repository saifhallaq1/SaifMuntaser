<?php
/* The password reset form, the link to this page is included
   from the forgot.php email message
*/
require_once 'includes/messages.php';
require_once 'classes/Database.php';
require_once 'classes/User.php';

session_start();

// Make sure email and hash variables aren't empty
if( isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']) )
{   
    $resetUser = new User;


    $safeEmail = $resetUser->sanitize($_GET['email']); 
    $safeHash = $resetUser->sanitize($_GET['hash']); 

    if($resetUser->checkIfUserIsExistForResetPassword($safeEmail,$safeHash)){
      // everything worked fine
    }else{
      $_SESSION['message'] = "You have entered invalid URL for password reset!";
       // header("location: error.php");
    }
}
else {
    $_SESSION['message'] = "Sorry, verification failed, try again!";
    //header("location: error.php");  
}
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Reset Your Password</title>
  <link href="csss/style.css" rel="stylesheet">
</head>

<body>
    <div class="form">

          <h1>Choose Your New Password</h1>
          
          <form action="reset_password.php" method="post">
              
          <div class="field-wrap">
            <label>
              New Password<span class="req">*</span>
            </label>
            <input type="password" required name="newpassword" autocomplete="off"/>
          </div>
              
          <div class="field-wrap">
            <label>
              Confirm New Password<span class="req">*</span>
            </label>
            <input type="password" required name="confirmpassword" autocomplete="off"/>
          </div>
          
          <!-- This input field is needed, to get the email of the user -->
          <input type="hidden" name="email" value="<?= $safeEmail ?>">    
          <input type="hidden" name="hash" value="<?= $safeHash ?>">    
              
          <button class="button button-block"/>Apply</button>
          
          </form>

    </div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

</body>
</html>
