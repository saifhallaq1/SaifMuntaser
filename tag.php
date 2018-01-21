<?php

require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Question.php';
require_once 'classes/Answer.php';
require_once 'classes/Category.php';
require_once 'classes/Comment_Answer.php';

if(empty($_GET['tags']))
    


$str = $_GET['hidden-tags'];
$str .= ',';
$tags = array();
$strlen = strlen( $str );
$tag = "";

for( $i = 0; $i <= $strlen; $i++ ) {
    $char = substr( $str, $i, 1 );
    if ($char != ',') {
        # code...
        $tag .= $char;
        
    }else{
        //$tags[] = $tag;
        //echo '<br>'.$tag.'   ';
        array_push($tags, $tag);
        $tag = '';
    }   
}
print_r($tags);


    if(isset($_GET['tags']) && !empty($_GET['tags'])){
        echo $_GET['name'];
    }
    

?>






<!DOCTYPE html>

<html>

<head>


    <title>PHP - Input multiple tags with dynamic autocomplete example</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/tagmanager/3.0.2/tagmanager.min.css">



    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tagmanager/3.0.2/tagmanager.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
     


</head>

<body>


<div class="container">

     <h5 class="text-muted modified-text"> Tags:
        <span class="badge badge-primary ">Caculus</span>
        <span class="badge badge-primary">PHP</span>
        <span class="badge badge-primary">Java</span>
        <span class="badge badge-primary">English</span>
    </h5>

    <div class="form-group">

    <label>Add Tags:</label><br/>

    <input type="text" name="tags" autocomplete="off" placeholder="Tags" class="typeahead tm-input form-control tm-input-info"/>

    </div>
</div>


<script type="text/javascript">

  $(document).ready(function() {

    var tagApi = $(".tm-input").tagsManager();


    jQuery(".typeahead").typeahead({

      name: 'tags',

      displayKey: 'name',

      source: function (query, process) {

        return $.get('ajaxpro.php', { query: query }, function (data) {

          data = $.parseJSON(data);
          return process(data);

        });

      },

      afterSelect :function (item){
        
            tagApi.tagsManager("pushTag", item);
      }

    });

  });

</script>


</body>
 
</html>