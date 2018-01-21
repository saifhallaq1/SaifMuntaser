 

<?php 
 
 $registerUser = new User(); // We instantiate the object

$_SESSION['email'] = $_POST['email'];
$_SESSION['username'] = $_POST['username'];

$hash =  md5( rand(0,1000) );



$safeUsername = $registerUser->sanitize($_POST['username']);
$safeFirstname = $registerUser->sanitize($_POST['firstname']);
$safeLastname = $registerUser->sanitize($_POST['lastname']);
$safeEmail = $registerUser->sanitize($_POST['email']);
$safePassword = $registerUser->sanitize($_POST['password']);
$safeGender = $registerUser->sanitize($_POST['gender']);
$safeHash = $registerUser->sanitize($hash);

$hashPassword = password_hash($safePassword, PASSWORD_BCRYPT);


if($registerUser->chechIfUserIsExistForRegister($safeUsername,$safeEmail)){

    $_SESSION['message'] = 'User with this email already exists!';
    header("location: error.php");
}else{// Email doesn't already exist in a database, proceed...
    
    // active is 0 by DEFAULT (no need to include it here)

    // Add user to the database
    if ($registerUser->registerUser($safeFirstname, $safeLastname, $safeUsername, $safeEmail, $hashPassword, $safeGender, $safeHash)){
       

        $_SESSION['active'] = 0; //0 until user activates their account with verify.php
        $_SESSION['register'] = true; // So we know the user has logged in
        $_SESSION['message'] ="Confirmation link has been sent to $safeEmail, please verify your account by clicking on the link in the message!";

        // Send registration confirmation link (verify.php)
        $to      = $safeEmail;
        $subject = 'Account Verification';
        $message_body = '
        Hello '.$safeFirstname.',

        Thank you for signing up!

        Please click this link to activate your account:

        http://localhost/project/verify.php?email='.$safeEmail.'&hash='.$safeHash;  

        mail( $to, $subject, $message_body );

        header("location: welcomepage.php"); 

    }else {
        
        $_SESSION['message'] = 'Registration failed!';
       
        header("location: profile.php");
    }

}


