
<?php

require_once 'includes/messages.php';
require_once 'classes/Database.php';
require_once 'classes/User.php';
session_start();

$studentId = new User;
$userId = '';
$groupId = '';


if($_SERVER['REQUEST_METHOD'] == 'GET') {


    //user is logged in!
    if (isset($_GET['user']) && !empty($_GET['user']) && isset($_GET['group']) && !empty($_GET['group'])) {
        echo "hshshs";
        $studentId = new User;

        $userId = $_GET['user'];
        $groupId = $_GET['group'];
        $userIdSession = "";
        if (isset($_SESSION)){
            if (isset($_SESSION['user_id']))
            $userIdSession = $_SESSION['user_id'];
        }


        if (isset($_SESSION) && $studentId->checkIfUserIsExistByID($_GET['user']) && $userIdSession == $_GET['user']) {

            header("location: reviewRate.php?user=".$_GET['user']."&group=".$_GET['group']);


        } else {

            //user didn't log in!
            $_SESSION['message'] = "session is not defined!";
            echo "session is not defined!";
            if(isset($_SESSION)){
                session_unset();
                session_destroy();

            }

        }

    }else{
        header("Location: index.php");
    }

}elseif($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['usernameOrEmail']) && !empty($_POST['usernameOrEmail']) && isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['user']) && !empty($_POST['user']) && isset($_POST['group']) && !empty($_POST['group'])){
        $loginUser = new User();
        $safeUsernameOrEmail = $loginUser->sanitize($_POST['usernameOrEmail']);
        $safePassword = $loginUser->sanitize($_POST['password']);

        if ($loginUser->checkIfUserIsExistForLogin($safeUsernameOrEmail, $safePassword)) {

            if($loginUser->getActive() != 0){
                $_SESSION['email'] = $loginUser->getEmail();
                $_SESSION['username'] = $loginUser->getUsername();
                $_SESSION['user_id'] = $loginUser->getUser_id();

                // This is how we'll know the user is logged in

                $_SESSION['logged_in'] = true;

                header("location: reviewRate.php?user=".$_POST['user']."&group=".$_POST['group']);
            }else{
                $_SESSION['message'] = "Incorrect email or password, try again!";
                header("location: loginRR.php?user=".$_POST['user']."&group=".$_POST['group']);
            }

        } else {

            $_SESSION['message'] = "Incorrect email or password, try again!";
            header("location: loginRR.php?user=".$_POST['user']."&group=".$_POST['group']);
        }
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="csss/loginStyle.css">
</head>
<body>

    <div class="form">
        <p>
            <?php
            if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ):
                echo $_SESSION['message'];
            else:
                //header( "location: index.php" );
            endif;
            ?>
        </p>
        <a href="index.php"><button class="button button-block" >Home</button></a>
    </div>


    <div class = "container">
        <div class="wrapper">
            <form action="loginRR.php" method="post"  class="form-signin">
                <h3 class="form-signin-heading">Welcome Back! Please Sign In</h3>
                <hr class="colorgraph"><br>

                <input type="text" class="form-control" name="usernameOrEmail" placeholder="Username or email" required="" autofocus="" />
                <input type="password" class="form-control" name="password" placeholder="Password" required=""/>
                <input type="hidden" name="group" value="<?php echo $groupId; ?>" >
                <input type="hidden" name="user" value="<?php echo $userId; ?>" >
                <input type="Submit" class="btn btn-lg btn-primary btn-block"  name="reviewRate" value="Login" />
            </form>
        </div>
</div>
</body>
</html>
