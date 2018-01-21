<?php 

require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Group.php';
require_once 'classes/Category.php';
require_once 'classes/Student.php';
require_once  'classes/Group_Tag.php';
require_once  'classes/Tag.php';
require_once  'classes/Student.php';

session_start();


if($_SESSION['logged_in'] != 1){
    $_SESSION['message'] = "You must log in!";
    header("location: error.php");
}else{

    //$newUser = new User;
    //$username = $_SESSION['username'];
    //$email = $_SESSION['email'];

    $viewGroup = new Group;

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {   

        if ( isset($_GET['group_id']) && !empty($_GET['group_id']) && isset($_GET['status']) && !empty($_GET['status'])) {
            echo $_GET['status'];
            $viewGroup->getGroupInfoFromDatabase($_GET['group_id']);

            $tutor = new User;
            $tutor->getUserInfoFromDatabase($viewGroup->getTutor());


            if ($_SESSION['user_id'] == $viewGroup->getTutor()){
                //user is tutor

                $status = $_GET['status'];
                if ($status == "pending"){
                    //echo " pending";
                    $updatedStatus = "started";
                    if($viewGroup->updateStatus($updatedStatus,$viewGroup->getGroup_id())){
                        //echo " pending1";
                        header("Location: tutoringClass.php?group_id=".$viewGroup->getGroup_id());
                    }else{
                        //echo " not pending1";
                        header("Location: tutoringClass.php?group_id=".$viewGroup->getGroup_id());
                    }
                }
                elseif($status == "started"){

                    $updatedStatus = "done";
                    if($viewGroup->updateStatus($updatedStatus,$viewGroup->getGroup_id())){
                        $getStudent = new Student;
                        $students = $getStudent->getStudentsByGroupId($viewGroup->getGroup_id());
                        if ($students != 0){
                            foreach ($students as $studentRow){
                                $getStudentInfo = new User;
                                $getStudentInfo->getUserInfoFromDatabase($studentRow['student_id']);
                                $getTutorInfo = new User;
                                $getTutorInfo->getUserInfoFromDatabase($viewGroup->getTutor());
                                $tutorGender = '';
                                if ($getTutorInfo->getGender() == 'male'){
                                    $tutorGender = "Mr. ";
                                }else{
                                    $tutorGender = "Ms. ";
                                }

                                $viewGroup->sendRateAndReviewEmailToStudents($getStudentInfo->getUsername(), $getStudentInfo->getUser_id(), $getStudentInfo->getEmail(), $tutorGender, $getTutorInfo->getUsername());
                            }
                        }

                        header("Location: tutoringClass.php?group_id=".$viewGroup->getGroup_id());
                    }else{
                       header("Location: tutoringClass.php?group_id=".$viewGroup->getGroup_id());
                    }

                }else{
                    header("Location: tutoringClass.php?group_id=".$viewGroup->getGroup_id());
                }

            }else {
                header("Location: find.php");
            }

        }else{
                //header("location: find.php");
        }
    }else{
        //header("Location: find.php");
    }
}


?>