
<?php 

require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Group.php';
require_once 'classes/Category.php';
require_once 'classes/Tag.php';
require_once 'classes/Group_Tag.php';
require_once 'classes/Lecture.php';
session_start();


if($_SESSION['logged_in'] != 1){
    $_SESSION['message'] = "You must log in!";
    header("location: error.php");
}else{


    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        if ( isset($_GET['group_title']) && !empty($_GET['group_title']) && isset($_GET['hourly_rate']) && !empty($_GET['hourly_rate']) && isset($_GET['numberOfStudents']) && !empty($_GET['numberOfStudents']) && isset($_GET['number_of_lectures']) && !empty($_GET['number_of_lectures']) && isset($_GET['group_description']) && !empty($_GET['group_description']) && isset($_GET['category']) && !empty($_GET['category']) && isset($_GET['tags']) && !empty($_GET['tags']) && isset($_GET['group_learning_outcomes']) && !empty($_GET['group_learning_outcomes']) && isset($_GET['scheduled_date']) && !empty($_GET['scheduled_date']) && isset($_GET['time']) && !empty($_GET['time'])) {
            $tags = explode(",",$_GET['tags']);
            $safeTags = [];

            $newGroup = new Group;
            $safeGroup_title = $newGroup->sanitize($_GET['group_title']);
            $safeGroup_description = $newGroup->sanitize($_GET['group_description']);
            $safeGroup_learning_outcomes = $newGroup->sanitize($_GET['group_learning_outcomes']);
            $safeCategory = $newGroup->sanitize($_GET['category']);

            $status = "pending";

            if($newGroup->addGroup($_SESSION['user_id'], $safeGroup_title, $safeGroup_description, $safeGroup_learning_outcomes, $status, $_GET['scheduled_date'], $_GET['time'], $_GET['hourly_rate'], $_GET['numberOfStudents'], $_GET['number_of_lectures'], $_GET['category'])){

                // add tag into tags table
                for($keyt = 0; $keyt< count($tags); $keyt++){
                    $checkTag = new Tag;
                    $safeTag = $checkTag->sanitize(strtolower($tags[$keyt]));
                    if($checkTag->checkTagIfExist($safeTag)){
                        $checkTag->getTagInfoFromDatabaseByText($safeTag);
                        $safeTags[] = $checkTag->getTag_id();
                    }else{
                        $newTag = new Tag;
                        if($newTag->addTag($safeTag)){
                            $safeTags[] = $newTag->getTag_id();
                        }
                    }
                }

                //add tags into group_tags table
                for ($tagKey = 0; $tagKey < count($safeTags); $tagKey++){
                    $add_group_tag = new Group_Tag;
                    if ($add_group_tag->addTagForGroup($newGroup->getGroup_id(),$safeTags[$tagKey])){
                        //tag is added
                    }
                }

                //add lectures into lectures table
                for ($lecture_number = 1; $lecture_number <= $_GET['number_of_lectures']; $lecture_number++){
                    if (isset($_GET['lecture_title'.$lecture_number]) && !empty($_GET['lecture_title'.$lecture_number]) && isset($_GET['lecture_date'.$lecture_number]) && !empty($_GET['lecture_date'.$lecture_number]) && isset($_GET['lecture_time'.$lecture_number]) && !empty($_GET['lecture_time'.$lecture_number]) && isset($_GET['lecture_location'.$lecture_number]) && !empty($_GET['lecture_location'.$lecture_number]) && isset($_GET['lecture_description'.$lecture_number]) && !empty($_GET['lecture_description'.$lecture_number]) ){
                        $add_lecture = new Lecture;

                        $safe_lecture_title = $add_lecture->sanitize($_GET['lecture_title'.$lecture_number]);
                        $safe_lecture_description = $add_lecture->sanitize($_GET['lecture_description'.$lecture_number]);
                        $safe_lecture_location = $add_lecture->sanitize($_GET['lecture_location'.$lecture_number]);
                        $lecture_date = $_GET['lecture_date'.$lecture_number];
                        $lecture_time = $_GET['lecture_time'.$lecture_number];
                        $lecture_date_time = date('Y-m-d H:i:s', strtotime("$lecture_date $lecture_time"));
                        if ($add_lecture->addLecture($safe_lecture_title, $safe_lecture_description, $lecture_date_time, $safe_lecture_location, $newGroup->getGroup_id() )){
                            //lecture has been added successfully
                            echo "true";
                        }
                    }

                }


                //header("Location: tutoringclass.php?group_id=". $newGroup->getGroup_id());
                
            }else{
         
               //header("Location: find.php");
            }


        }else{
        	//header("Location: find.php");
        }
    }else{
    	// header("Location: find.php");
    }
}

?>