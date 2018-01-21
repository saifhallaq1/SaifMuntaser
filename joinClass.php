<?php

require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Group.php';
require_once 'classes/Group_Tag.php';
require_once 'classes/Category.php';
require_once 'classes/Student.php';

session_start();


if($_SESSION['logged_in'] != 1){
    $_SESSION['message'] = "You must log in!";
    header("location: error.php");
}else {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        if (isset($_GET['group_id']) && !empty($_GET['group_id']) && isset($_GET['student_id']) && !empty($_GET['student_id'])) {
            if ($_SESSION['user_id'] = $_GET['student_id']){
                $addStudent = new Student;
                if ($addStudent->addStudentInGroup($_GET['group_id'], $_SESSION['user_id'])){
                    //student has been added
                    header("Location: tutoringClass.php?group_id=".$_GET['group_id']);
                }else{
                    header("Location: tutoringClass.php?group_id=".$_GET['group_id']);
                }
            }else{
                header("Location: tutoringClass.php?group_id=".$_GET['group_id']);
            }
        }else{
            header("Location: find.php");
        }
    }else{
        header("Location: find.php");
    }

}

?>