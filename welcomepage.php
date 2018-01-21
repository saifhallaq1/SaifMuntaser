<?php 

session_start();

if($_SESSION['register'] != 1){
	$_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");
}else{
	
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
}

?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Welcome <?= $username.' your email is '.$email ?></title>
    <link rel="stylesheet" href="csss/style.css">
</head>

<body>
  <div class="form">

          <h1>Welcome</h1>
          
          <p>
          <?php 
     
          // Display message about account verification link only once
          if ( isset($_SESSION['message']) )
          {
              echo $_SESSION['message'];
              
              // Don't annoy the user with more messages upon page refresh
              unset( $_SESSION['message'] );
          }
          
          ?>
          </p>
          
          <?php
          
          // Keep reminding the user this account is not active, until they activate
          if ( !$active ){
              echo
              '<div class="info">
              Account is unverified, please confirm your email by clicking
              on the email link!
              </div>';
          }
          
          ?>
          
          <h2><?php echo $username.' '.$email; ?></h2>
          
          
          <a href="logout.php"><button class="button button-block" name="logout"/>Log Out</button></a>

    </div>
    
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

</body>
</html>
