<?php

$loginUser = new User();
$safeUsernameOrEmail = $loginUser->sanitize($_POST['usernameOrEmail']);
$safePassword = $loginUser->sanitize($_POST['password']);

if($loginUser->checkIfUserIsExistForLogin($safeUsernameOrEmail, $safePassword)){

    if($loginUser->getActive() != 0){
    	$_SESSION['email'] = $loginUser->getEmail();
    	$_SESSION['username'] = $loginUser->getUsername();
    	$_SESSION['user_id'] = $loginUser->getUser_id();
    	
    	// This is how we'll know the user is logged in

	    $_SESSION['logged_in'] = true;

	    
        header("location: Home.php");
    }else{
    	$_SESSION['message'] = "Account is unverified, please confirm your email by clicking on the email link!";
    	header("location: error.php");
    }
}else{

    $_SESSION['message'] = "Incorrect email or password, try again!";
    header("location: error.php");
}
