<?php

require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Question.php';
require_once 'classes/Answer.php';
require_once 'classes/Category.php';
require_once 'classes/Comment_Answer.php';
session_start();


if($_SESSION['logged_in'] != 1){
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location: error.php");
}else{



	if (isset($_GET['categoryt']) && !empty($_GET['categoryt'])) {
	    # code...
	    
	    $category_title = $_GET['categoryt'];
	    $checkCategory = new Category;

	    $viewQuestions = new Question;

	    if($category_title == "AllCategories"){
	    	//get all questions
		    $questions = $viewQuestions->getAllQuestions();

	    }elseif($checkCategory->getCategoryInfoFromDatabase($category_title)){
	    	$questions = $viewQuestions->getQuestionsbyCategory($checkCategory->getcategory_id());
	    }else{
	    	$questions = null;
	    }
	    
	    if($questions){
	    	$countA = 1;

	        foreach($questions as $questionRow) {

	        $question_owner = new User;
	        $question_owner->getUserInfoFromDatabase($questionRow['question_owner']);
            $answerlist = new Answer;
            $answers = $answerlist->getAnswersOfQuestion($questionRow['question_id']);
            
            if(count($answers) != 0){
            	$counterA = count($answers);
            }else{
            	$counterA = 0;
            }
?>
            <div class="card mb-4">

                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-2 questionborder">
                            <img src="img/profile-pictures.png" class="profile-img">
                            <div class="username"> 
                            	<a href="viewProfile.php?user_id=<?= $questionRow['question_owner']; ?>"><?= $question_owner->getUsername(); ?></a> 
                            </div>
                            <div class="stars"><div class="ext-center">

                            <div class="review-block-rate">

                                <span class="fa fa-star" aria-hidden="true"></span>

                                <span class="fa fa-star" aria-hidden="true"></span>

                                <span class="fa fa-star" aria-hidden="true"></span>

                                <span class="fa fa-star" aria-hidden="true"></span>

                                <span class="fa fa-star" aria-hidden="true"></span>

                             </div></div></div>

                        </div>

                        <div class="col-md-10">
                    <h2 class="card-title"><?= $questionRow['question_title']; ?></h2>
                    <p class="card-text "><?= $questionRow['question_body']; ?></p>

                        <span class="text-muted pull-right"><?= $counterA; ?> Answers</span>

                    </div>
                    </div>
                </div>


                <div class="card-footer text-muted cardfooteredited ">

                  <!--  <img src="img/profile-pictures.png" class="input-profile-image">  <input type="text" id="inputbox">  <a  data-toggle="collapse" href="#Answer1" aria-expanded="false" aria-controls="Answer">
                        0 Answers<i class="fa fa-commenting-o" aria-hidden="true"></i></a>  <i class="fa fa-thumbs-o-up float-lg-right" aria-hidden="true">0  </i><i class="fa fa-thumbs-o-down float-lg-right" aria-hidden="true">0</i>
                    <button class="btn btn-primary buttton" data-toggle="modal" data-target="#myModal1">Edit </button> -->                 

                    <a  data-toggle="collapse" href="#Answer<?= $countA; ?>" aria-expanded="false" aria-controls="Answer">
                        <i class="fa fa-commenting-o fa-2x" style="padding-left: 2px" aria-hidden="true"></i></a> <i class="fa fa-thumbs-o-up fa-2x" style="padding-left: 20px" aria-hidden="true"></i>
                </div>
            </div>

          <?php
           if($answers){
	    
	        foreach($answers as $answerRow) {

	        $answer_owner = new User;
	        $answer_owner->getUserInfoFromDatabase($answerRow['answer_owner']);
			?>
            <div class="collapse answercard11" id="Answer<?= $countA; ?>">
                <div class="edited-input-filed-comments">
                <img src="img/profile-pictures.png" class="input-profile-image">  <input type="text" id="inputbox">
                </div>
                    <div class="card no-border">
<br>

                          <div class="row commentsrow">

                              <div class="col-md-1 space">
                                  <img src="img/profile-pictures.png" class="input-profile-image1">
                              </div>


                              <div id="ratingbox1">
                              <div class="col-md-11 ">

                                  <a href="viewProfile.php?user_id=<?= $answerRow['answer_owner']; ?>"><b style="font-size: 24px;"><?= $answer_owner->getUsername(); ?></b>
                                  </a>
                                  <?= $answerRow['answer_text']; ?>
                              </div>
                          </div>


                      </div>

  
                </div>

            </div>
            
            <?php
            // end of the foreach for answers 
            
        		}
        	}
    		 ?>
		<?php 
            // end of the foreach for questions 

			$countA++;
			}
		} 
	}
}
?>
