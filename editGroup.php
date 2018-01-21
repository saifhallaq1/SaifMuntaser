
<?php

require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Group.php';
require_once 'classes/Category.php';
require_once 'classes/Tag.php';
require_once 'classes/Group_Tag.php';
session_start();


if($_SESSION['logged_in'] != 1){
    $_SESSION['message'] = "You must log in!";
  header("location: error.php");
    
}else{
  
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {


        if(isset($_GET['group_id']) && !empty($_GET['group_id'])  && isset($_GET['group_title']) && !empty($_GET['group_title']) && isset($_GET['capacity']) && !empty($_GET['number_of_lectures']) && isset($_GET['number_of_lectures']) && !empty($_GET['capacity']) && isset($_GET['hourly_rate']) && !empty($_GET['hourly_rate']) && isset($_GET['group_description']) && !empty($_GET['group_description']) && isset($_GET['group_learning_outcomes']) && !empty($_GET['group_learning_outcomes']) && isset($_GET['time']) && !empty($_GET['time']) && isset($_GET['scheduled_date']) && !empty($_GET['scheduled_date']) && isset($_GET['category']) && !empty($_GET['category'])){
            $editGroup = new Group;
            $editGroup->getGroupInfoFromDatabase($_GET['group_id']);
            if ($_SESSION['user_id'] == $editGroup->getTutor()) {

                //set new values
                $editGroup->setGroup_title($editGroup->sanitize($_GET['group_title']));

                $editGroup->setCategory($_GET['category']);

                $editGroup->setHourly_rate($_GET['hourly_rate']);

                $editGroup->setGroup_description($editGroup->sanitize($_GET['group_description']));

                $editGroup->setGroup_learning_outcomes($editGroup->sanitize($_GET['group_learning_outcomes']));

                $scheduled_date = $_GET['scheduled_date'];
                $time = $_GET['time'];
                $combinedDT = date('Y-m-d H:i:s', strtotime("$scheduled_date $time"));
                $editGroup->setScheduled_date_time($combinedDT);

                $editGroup->setNumberOfStudents($_GET['capacity']);
                $editGroup->setNumber_of_lectures($_GET['number_of_lectures']);

                //update new values in DB
                $editGroup->updateGroupInfo($_GET['group_id']);


                    //tags section
                if (isset($_GET['tags']) && !empty($_GET['tags'])) {
                    $tags = explode(",",$_GET['tags']);
                    $safeTags = [];

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

                    $group_tags = new Group_Tag;
                    $group_tags_list = $group_tags->getTagsByGroupId($_GET['group_id']);
                    if($group_tags_list != 0){

                        foreach ($group_tags_list as $tagRow) {
                            if (!in_array($tagRow['tag_id'], $safeTags)) {
                                $delete_group_tag = new Group_Tag;
                                $delete_group_tag->deleteTag($_GET['group_id'], $tagRow['tag_id']);
                            }

                        }

                        for ($tagKey = 0; $tagKey < count($safeTags);$tagKey++) {
                            $check_group_tag = new Group_Tag;
                            if(!$check_group_tag->checkTagIfExist($_GET['group_id'],$safeTags[$tagKey])){
                                $add_group_tag = new Group_Tag;
                                if ($add_group_tag->addTagForGroup($_GET['group_id'],$safeTags[$tagKey])){
                                    //tag is added
                                }
                            }
                        }
                    }else{
                        for ($tagKey = 0; $tagKey < count($safeTags); $tagKey++){
                            $add_group_tag = new Group_Tag;
                            if ($add_group_tag->addTagForGroup($_GET['group_id'],$safeTags[$tagKey])){
                                //tag is added
                            }
                        }
                    }

                }



                header("Location: tutoringclass.php?group_id=".$_GET['group_id']);
            }else{
             header("location: find.php");
            }
        }else{
             header("location: find.php");
        }
    }else{
       header("location: find.php");
    }
}