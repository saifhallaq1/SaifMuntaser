<!DOCTYPE HTML>
<html>
<head>


    <?php include_once ("header.php"); ?>


    <!-- Custom styles for this template -->
    <link href="css/scrolling.css" rel="stylesheet">
    <!-- font awesome -->
    <link href="css/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">

    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom JavaScript for this theme -->
    <script src="js/scrolling-nav.js"></script>

</head>
<body>
<?php include_once ("header1.php"); ?>
<div class="container">
    <form action=".php" method="get">
        <div class="headerr">
           <center> Thank YOU For using LEEO!</center>
        </div>
        <center> Your feedback is very important for achieving our goal of building a quality program. Your honest responses will be appreciated</center>

        <br/>
        <div class="rate">
            <center><h1>Rate:</h1><input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="2"></center>
        </div>

        <div class="form-group">
             <center>Comment:</center>
            <textarea rows="7" name="comment" cols="120" >Insert Your Review Here</textarea>
        </div>

        <input type="submit" class="btn-danger" value="Submit" name="reviewRate">
    </form>
</div>

<script>
    $("#input-id").rating();
</script>
<br>
<?php
include_once("footer.php");
?>
</body>
</html>