<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Contact</title>

    <?php
    include_once("header1.php")
    ?>

</head>

<body>





<?php
include_once("header.php")
?>


<!-- page content -->



<br>
<br>
<br>




<div class="container">
    <div class="row">

        <div class="col-lg-3 mx-auto photorow">
            <img src="/SaifMuntaser/img/contact.png" id="questionimage" class="rounded float-left" alt="myimg">
        </div>

      <div class="col-lg-9 mx-auto">
          <form>

                  <div class="form-group row">
                      <label for="Name" class="col-sm-1 col-form-label">Name:</label>
                      <div class="col-sm-9">
                          <input  class="form-control" id="Name" placeholder="Enter Your Name" required>
                      </div>
                  </div>



              <div class="form-group row">
                  <label for="Email" class="col-sm-1 col-form-label">Email:</label>
                  <div class="col-sm-9">
                      <input type="email" class="form-control" id="Email" aria-describedby="emailHelp" placeholder="Enter Your Email" required>
                  </div>
              </div>




              <div class="form-group row">
                  <label for="phonenumber" class="col-lg-2 col-form-label">Phone Number:</label>
                  <div class="col-sm-8">
                      <input type="text" class="form-control" id="phoneNumber" placeholder="Enter Your PhoneNumber" required>
                  </div>
              </div>



              <div class="form-group">
                  Your Message:
                             <div class="col-sm-10">

                            <textarea class="form-control form-rounded" rows="5" required></textarea><br>
                            <button class="btn btn-primary text-center"> submit</button>

              </div>
              </div>
          </form>



      </div>


    </div>
</div>
</div>
<br>
<br>


<?php
include_once('Footer.php');
?>

</body>

</html>
