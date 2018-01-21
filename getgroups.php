<?php

require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Group.php';
require_once 'classes/Group_Tag.php';
require_once 'classes/Category.php';
require_once 'classes/Tag.php';
include_once ('Header1.php');


session_start();


if($_SESSION['logged_in'] != 1){
    $_SESSION['message'] = "You must log in!";
    header("location: error.php");
}else {


    if (isset($_GET['categoryt']) && !empty($_GET['categoryt'])) {

        $category_title = $_GET['categoryt'];
        $checkCategory = new Category;

        $viewGroups = new Group;

        if ($category_title == "AllCategories") {
            //get all groups
            $groups = $viewGroups->getAllGroups();

        } elseif ($checkCategory->getCategoryInfoFromDatabase($category_title)) {
            $groups = $viewGroups->getGroupsByCategory($checkCategory->getcategory_id());
        } else {
            $questions = null;
        }

        if ($groups) {
            foreach ($groups as $groupRow) {
                $tutor = new User;
                $tutor->getUserInfoFromDatabase($groupRow['tutor']);

                ?>


                <div class="row">
                    <div class="col-md-2" style="padding-top: 20px;">
                        <img src="img/15356507_1364357016940040_4438434916611401275_n.jpg" class="img-rounded"
                             style="width: 150px;" style="height: 150px;">
                        <div class="course-block-name" style="font-size: 22px; padding-top: 10px;"><a id="111" href="viewProfile.php?user_id=<?= $groupRow['tutor']; ?>"><?= $tutor->getUsername(); ?></a></div>
                    </div>
                    <div class="col-md-10" style=" padding-top: 15px;">

                        <div class="row">

                            <div class="col-md-7" style="padding-bottom: 12px;">
                                <div class="usernamefind">
                                    <span style="font-size: 37px;"><h5><?= substr($groupRow['group_title'],0,100).'...'; ?></h5></span>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="course-stars card-stars1 pull-right">


                                    <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                    <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                    <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                    <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                    <span class="fa fa-star fa-2x" aria-hidden="true"></span>


                                </div>
                            </div>
                        </div>


                        <h4>
                            <p style="font-size: 23px;"><h6><?= substr($groupRow['group_description'],0,300).'...'; ?></h6></p>
                        </h4>
                        <div class="tagsbox" style="padding-bottom: 5px; margin-bottom: 5px;">

                            <h3>Tags:
                                <i class="fa fa-hashtag" style="color: grey" aria-hidden="true"></i>
                                    <?php
                                    $view_group_tags = new Group_Tag;
                                    $tags_list = $view_group_tags->getTagsByGroupId($groupRow['group_id']);
                                    if ($tags_list){
                                        foreach ($tags_list as $tagG){
                                            $getTag = new Tag;
                                            $getTag->getTagInfoFromDatabaseById($tagG['tag_id']);
                                            echo "<span class=\"badge badge-primary \">".$getTag->getTag_text()."</span>";
                                        }
                                    }

                                    ?>
                            </h3>
                            <h3><i class="fa fa-money " style="color: grey;" aria-hidden="true"> <?= $groupRow['hourly_rate']; ?>JD Per Hour</i></h3>
                        </div>
                        <div class="dateofcreation">
                            <span class="text-muted pull-right"> Date Of creation: <?= $groupRow['dateOfCreation']; ?></span>
                        </div>
                        <div class="findbuttons" style="padding-bottom: 7px;">
                            <a href="tutoringClass.php?group_id=<?= $groupRow['group_id']; ?>" class="btn btn-success">View</a>
                        </div>
                    </div>
                </div>
                    <hr>
                <?php
            }
        }
    }
}
?>