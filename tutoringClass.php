
<?php 

require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Group.php';
require_once 'classes/Category.php';
require_once 'classes/Student.php';
require_once  'classes/Group_Tag.php';
require_once  'classes/Tag.php';
require_once  'classes/Student.php';
require_once  'classes/Lecture.php';

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

        if ( isset($_GET['group_id']) && !empty($_GET['group_id'])) {
            
            

            $viewGroup->getGroupInfoFromDatabase($_GET['group_id']);

            $tutor = new User;
            $tutor->getUserInfoFromDatabase($viewGroup->getTutor());

            $getCategory = new Category;
            $categoryRow = $getCategory->getCategoryInfoFromDatabaseById($viewGroup->getCategory());
            $status = '';
            $flag = '';
            if ($_SESSION['user_id'] == $viewGroup->getTutor()){
                //user is tutor
                $flag = 1;

            }else {


                $checkStudent = new Student();

                if ($checkStudent->checkStudentIsExist($_GET['group_id'], $_SESSION['user_id'])) {
                    //user is exist
                    $flag = 2;


                } else {
                    //user is not exist
                    $flag = 3;
                }
            }

            if($viewGroup->getStatus() == "pending"){
                $status = 1;
                $statusMsg = "Start Class";
            }elseif($viewGroup->getStatus() == "started"){
                $statusMsg = "finish Class";
                $status = 2;
            }elseif($viewGroup->getStatus() == "done"){
                $statusMsg = "";
                $status = 3;
            }
            $getStudent = new Student;
            $students = $getStudent->getStudentsByGroupId($_GET['group_id']);


        }else{
            header("location: find.php");
        }
    }else{
        header("Location: find.php");
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tutoring Class</title>

    <?php
    include_once("header1.php");
    ?>

</head>

<body class="modified-text">


<!-- Navigation -->

<?php
include_once('header.php');

?>

<div class="container">
    <div class="row">
        <div class="col-md-3">

            <div class="conatiner">
                <div class="card cardowner">
                    <div class="card-header">
                        Tutor
                    </div>

                    <img src="img/img_avatar1.png"  class="ownerimage rounded-circle">
                    <div class="card-body text-center">
                        <h4 class="card-title-1"><?= $tutor->getUsername(); ?></h4>
                    </div>
                    <div class="article-stars1 text-center">

                        <div class="review-block-rate">

                            <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                            <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                            <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                            <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                            <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                        </div>
                    </div>

                    <a href="viewProfile.php?user_id=<?= $viewGroup->getTutor(); ?>" class="btn btn-primary">See Profile</a>

                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="jumbotron">
                <div class="container">
                    <div class="row ">
                        <div class="col-md-9 titlegroup  ">
                            <?php
                            if ($flag == 1 && ($status == 1 || $status == 2)){
                                $getGroup_Status = new Group;
                                $getGroup_Status->getGroupInfoFromDatabase($_GET['group_id']);
                                $getStatus = $getGroup_Status->getStatus();
                            ?>
                            
                            <a href="edit_tutorclass.php?group_id=<?= $viewGroup->getGroup_id(); ?>" class="btn btn-primary">Edit Your Tutoring Class</a>

                            <a href="groupStatus.php?group_id=<?= $viewGroup->getGroup_id(); ?>&status=<?= $getStatus; ?>" class="btn btn-primary"><?= $statusMsg; ?></a>
                            <?php }
                            ?>

                            <?php if ($flag == 2 && $status == 1){ ?>
                            <a href="leaveGroup.php?group_id=<?= $_GET['group_id']; ?>&student_id=<?= $_SESSION['user_id']; ?>" class="btn btn-danger">Leave</a>
                            <?php }?>


                            <h1><?= $viewGroup->getGroup_title(); ?></h1>


                        </div>

                        <div class="col-md-3 titlegroup ">

                            <?php

                            if(!empty($students)){ $studentsNum = count($students);}else{$studentsNum = 0;}
                            if ($flag == 3 && $studentsNum < $viewGroup->getNumberOfStudents() ){
                            ?>
                                <a href="joinClass.php?group_id=<?= $_GET['group_id']; ?>&student_id=<?= $_SESSION['user_id']; ?>" class="btn btn-danger">Join the Tutoring Class</a>
                            <?php }?>


                        </div>


                    </div>
                    <div class="row">
                        <div class="col-md-6 RegandCapgroup Article-body1">
                            N.Of Students Reg.: <span class="badge badge-primary"><?php if(!empty($students)){ echo count($students);}else{echo 0;} ?></span>

                        </div>
                        <div class="col-md-6 Article-body1">
                            Capacity:<span class="badge badge-success"><?= $viewGroup->getNumberOfStudents(); ?></span>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 Article-body1">

                            Price Per Hour: <?= $viewGroup->getHourly_rate(); ?>JD
                        </div>

                        <div class="col-md-6 Article-body1">

                            Scheduled (Date/Time): <?= $viewGroup->getScheduled_date_time(); ?>
                        </div>
                    </div>
                    <h5 class="text-muted modified-text"> Tags:
                        <?php
                        $view_group_tags = new Group_Tag;

                        $tags_list = $view_group_tags->getTagsByGroupId($viewGroup->getGroup_id());
                        if ($tags_list){
                            foreach ($tags_list as $tagG){
                                $getTag = new Tag;
                                $getTag->getTagInfoFromDatabaseById($tagG['tag_id']);
                                echo "<span class=\"badge badge-primary \">".$getTag->getTag_text()."</span>";
                            }
                        }

                        ?>
                    </h5>

                    <h5>Category: <?= $getCategory->getCategory_title(); ?></h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="title">
                                <h1><center>Learning Outcomes <i class="fa fa-crosshairs" aria-hidden="true"></i></center></h1>
                            </div>
                            <div class="Article-body1">
                                <?= $viewGroup->getGroup_learning_outcomes(); ?>
                                <hr>
                            </div>
                        </div>
                    </div>




                    <div>
                        <label>Enrolled Students</label>
                        <?php

                         if ($students) {
                        if($flag == 1) {
                            // students list
                            echo "<table>
                                <tr>
                                    <td>Username</td>
                                    <td>First Name</td>
                                    <td>Last Name</td>
                                    <td>University</td>
                             </tr> ";

                                foreach ($students as $row) {
                                    $getStudentInfo = new User;
                                    $getStudentInfo->getUserInfoFromDatabase($row['student_id']);

                                    echo "<tr>
                                    <td>" . $getStudentInfo->getUsername() . "</td>
                                    <td>" . $getStudentInfo->getFirstname() . "</td>
                                    <td>" . $getStudentInfo->getLastname() . "</td>
                                    <td>" . $getStudentInfo->getUniversity() . "</td>
                                </tr>
                                </table>";
                                }
                            }
                        }

                        ?>

                    </div>
                    <!--start Lectures List -->
                    <script type="text/javascript">
                        setTimeout(function(){ showUser("<?= $viewGroup->getGroup_id(); ?>"); },800);
                    </script>
                    <label> Lectures:</label>
                    <div class="row" id="txtHint"></div>
                    <!--end Lectures List -->
                    <hr><hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="title">
                                <h1><center>Description <i class="fa fa-search" aria-hidden="true"> </i></center></h1></div>
                            <div class="Article-body1">
                                <?= $viewGroup->getGroup_description(); ?>
                            </div>
                            <hr>
                            <h1><center>Questions <i class="fa fa-question" aria-hidden="true"></i></center></h1>
                        </div>

                        <div class="row">

                            <div class="col-md-1 space">
                                <img src="img/profile-pictures.png" class="input-profile-image1"> <a href="#">
                            </div>


                            <div id="ratingbox2">
                                <div class="col-md-11 ratingbox2">
                                    <b style="font-size: 24px;">$username</b></a>  At what time is the lecture ?
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



<?php
include_once("footer.php");
?>

</body>
<script>
    function showUser(str) {
        if (str == "") {
            document.getElementById("txtHint").innerHTML = "<div align='center'><h2>Sorry! There is no Tutoring Classes.</h2></div>";
            return;
        } else {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","getLecturesForGroup.php?group_id="+str,true);
            xmlhttp.send();
        }
    }
</script>
</html>