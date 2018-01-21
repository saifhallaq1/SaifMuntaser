<?php

require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Group.php';
require_once 'classes/Lecture.php';
include_once ('Header1.php');


session_start();


if($_SESSION['logged_in'] != 1){
    $_SESSION['message'] = "You must log in!";
    header("location: error.php");
}else {

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['group_id']) && !empty($_GET['group_id'])) {
            $getLectures = new Lecture;
            $lectures = $getLectures->getLecturesByGroup($_GET['group_id']);

            if ($lectures) {
                foreach ($lectures as $lectureRow) {


                    ?>


                    <div class="col-md-12">
                        <hr style="border: 1px solid #f00">
                        <label>Lecture Title</label>
                        <h4><?= $lectureRow['lecture_title']; ?></h4>
                    </div>

                    <br>


                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="Date">Date</label>
                            <?= $lectureRow['lecture_date_time']; ?>

                        </div>
                    </div>

                    <br>
                    <div class="col-md-12">

                        <div class="form-group">
                            <label>Lecture Location</label>
                            <p><?= $lectureRow['lecture_location']; ?></p>
                        </div>


                    </div>

                    <br>

                    <div class="col-md-12">

                        <div class="form-group">
                            <label>Lecture Description</label>
                            <h5><?= $lectureRow['lecture_description']; ?></h5>
                        </div>

                        <hr style="border: 1px solid #f00">
                    </div>

                    <?php

                }
            }
        }
    }
}
?>

