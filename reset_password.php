<?php
/* Password reset process, updates database with new user password */
require_once 'includes/messages.php';
require_once 'classes/Database.php';
require_once 'classes/User.php';
session_start();

// Make sure the form is being submitted with method="post"
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

    // Make sure the two passwords match
    if ( $_POST['newpassword'] == $_POST['confirmpassword'] ) { 
    	$resetUser = new User;

    	$safepassword = $resetUser->sanitize($_POST['newpassword']);

        $new_password = password_hash($safepassword, PASSWORD_BCRYPT);


        // We get $_POST['email'] and $_POST['hash'] from the hidden input field of reset.php form
        $safeEmail = $resetUser->sanitize($_POST['email']);
        $safeHash = $resetUser->sanitize($_POST['hash']);
        

        if($resetUser->resetPassword($safeEmail, $safeHash, $new_password)){
        	$_SESSION['message'] = "Your password has been reset successfully!";
       		header("location: success.php"); 
        }else{
        	$_SESSION['message'] = "Something wrong happened, try again!";
        	header("location: error.php"); 
        }
    }else {
        $_SESSION['message'] = "Two passwords you entered don't match, try again!";
        header("location: error.php");    
    }
    

}
?>