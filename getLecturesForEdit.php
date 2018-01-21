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
        if (isset($_GET['number_of_lectures']) && !empty($_GET['number_of_lectures'])) {

            for ($counter = 0; $counter < $_GET['number_of_lectures']; $counter++) {

                ?>


                <div class="col-md-12">
                    <hr style="border: 1px solid #f00">
                    <label>Lecture Title</label>
                    <input class="form-control" id="lecture_title" type="text" name="lecture_title<?= $counter+1; ?>"
                           placeholder="Insert your lecture title">
                </div>

                <br>


                <div class="col-md-5">
                    <div class="form-group">
                        <label for="Date">Date</label>
                        <input class="form-control" id="date" type="date" name="lecture_date<?= $counter+1; ?>">

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="time">Time</label>
                        <input class="form-control" id="date" type="time" name="lecture_time<?= $counter+1; ?>">

                    </div>
                </div>

                <br>
                <div class="col-md-12">

                    <div class="form-group">
                        <label>Lecture Location</label>
                        <input class="form-control" id="lecture_location" type="text" name="lecture_location<?= $counter+1; ?>"
                               placeholder="Insert lecture location">
                    </div>


                </div>

                <br>

                <div class="col-md-12">

                    <div class="form-group">
                        <label>Lecture Description</label>
                        <input class="form-control" id="lecture_description" type="text" name="lecture_description<?= $counter+1; ?>"
                               placeholder="Insert your lecture description">
                    </div>

                    <hr style="border: 1px solid #f00">
                </div>

                <?php

            }
        }
    }
}
?>

