<?php
/* Displays all error messages */
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Error</title>

    <link rel="stylesheet" href="csss/style.css">
</head>
<body>
<div class="form">
    <h1>Error</h1>
    <p>
    <?php 
    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ): 
        echo $_SESSION['message'];    
    else:
        header( "location: index.php" );
    endif;
    ?>
    </p>     
    <a href="logout.php">Home</a>
</div>
</body>
</html>