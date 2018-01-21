<?php 
require_once 'classes/Database.php';
require_once 'classes/User.php';
session_start();

// Make sure email and hash variables aren't empty
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){

    $verifyUser = new User();
    $safeEmail = $verifyUser->sanitize($_GET['email']); 
    $safeHash = $verifyUser->sanitize($_GET['hash']);

    if($verifyUser->verifyUserActivation($safeEmail,$safeHash)){
 
        $_SESSION['message'] = "Your account has been activated!";

        header("location: success.php");

    }else{
        $_SESSION['message'] = "Account has already been activated or the URL is invalid!";

        header("location: error.php");
    }
    
}else {
    $_SESSION['message'] = "Invalid parameters provided for account verification!";
    header("location: error.php");
}     
?>

