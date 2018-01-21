
<?php 

require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Question.php';
require_once 'classes/Answer.php';
require_once 'classes/Category.php';
require_once 'classes/Comment_Answer.php';
require_once 'classes/Tag.php';
require_once 'classes/Questions_Tags.php';

session_start();


if($_SESSION['logged_in'] != 1){
    $_SESSION['message'] = "You must login!";
    header("location: error.php");
}else{

    //$newUser = new User;
    //$username = $_SESSION['username'];
    //$email = $_SESSION['email'];

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {   

        if ( isset($_GET['question_title']) && !empty($_GET['question_title']) && isset($_GET['category']) && !empty($_GET['category']) && isset($_GET['tags']) && !empty($_GET['tags']) && isset($_GET['question_body']) && !empty($_GET['question_body'])) {

            $tags = explode(",",$_GET['tags']);
            $safeTags = [];

            $newQuestion = new Question;




            $safeQuestion_title = $newQuestion->sanitize($_GET['question_title']);
            $safeCategory = $newQuestion->sanitize($_GET['category']);
            $safeQuestion_body = $newQuestion->sanitize($_GET['question_body']);

            //$getCategory = new Category;
            //$getCategory->getCategoryInfoFromDatabase($safeCategory);

            if($newQuestion->addQuestion($safeQuestion_title, $safeQuestion_body, $_SESSION['user_id'], $safeCategory)){

                for($keyt = 0; $keyt< count($tags); $keyt++){
                    $checkTag = new Tag;
                    $safeTag = $checkTag->sanitize($tags[$keyt]);
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

                for ($tagKey = 0; $tagKey < count($safeTags); $tagKey++){
                    $addQuestion_tag = new Questions_Tags;
                    if ($addQuestion_tag->addTagForQuestion($newQuestion->getQuestion_id(),$safeTags[$tagKey])){
                        // its working
                    }
                }

                header("Location: Q&A.php");
                
            }else{
         
               header("Location: Q&A.php");
            }

        }else{
        	header("Location: Q&A.php");
        }
    }else{
    	header("Location: Q&A.php");
    }
}

?>