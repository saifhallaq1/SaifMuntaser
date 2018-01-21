
<?php 

require_once 'classes/Database.php';
require_once 'classes/User.php';
session_start();


if($_SESSION['logged_in'] != 1){
    $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");
}else{
    
    

     
    

    
       
}


?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tutoring Class</title>

    <?php
    include_once("header1.php")
    ?>

</head>
<body class="modified-text">

<?php
include_once("header.php")
?>

<div class="container-fluid containerhome">

    <div class="row">
        <div class="col-md-2 col-sm-1 menuside">
            <div class="container">



                    <img src="img/15356507_1364357016940040_4438434916611401275_n.jpg"  class="ownerimage rounded-circle">
                    <div class="card-body text-center">
                       <b> <h4 class="card-title-1">Muntaser Mraisi</h4></b>
                    </div>
                <div class="article-stars1 text-center">

                    <div class="review-block-rate">

                        <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                        <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                        <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                        <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                        <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                    </div></div>

                <div class="profile-info">


                    <div class="padding-info">

                        <span id="Age"><i class="fa fa-birthday-cake modifi" aria-hidden="true"> 20-12-2012</i></span>

                    </div>

                    <div class="padding-info">

                        <span id="Gender"><i class="fa fa-venus-mars" aria-hidden="true"> Male</i></span>

                    </div>

                    <div class="padding-info">

                        <i class="fa fa-bolt" aria-hidden="true">Bechlor Degree</i>

                    </div>

                    <div class="padding-info">

                        <i class="fa fa-phone" aria-hidden="true">0798941345 </i>

                    </div>


                    <div class="padding-info">

                        <span id="uni">  <i class="fa fa-university" aria-hidden="true"> German Jordanian Univerty</i></span>

                    </div>
                </div>


        </div>
    </div>


        <div class="col-md-10 homerow">
            <h1> <i class="fa fa-check" style="padding-top: 10px" aria-hidden="true">Hello Muntaser Mraisi! </h2></i>

                <BR>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">


                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Courses</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" data-toggle="tab" href="#OfferedCourses" role="tab">Offered Courses</a>
                        <a class="dropdown-item" data-toggle="tab" href="#myCourses" role="tab">My Courses</a>

                    </div>
                </li>

                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Questions</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" data-toggle="tab" href="#2Questions" role="tab">My Questions</a>
                        <a class="dropdown-item" data-toggle="tab" href="#Answers" role="tab">My Answers</a>

                    </div>
                </li>


                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#Articles1" role="tab">Articles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#settings" role="tab">Settings</a>
                </li>


            </ul>

            <!-- Tab panes -->
            <div class="tab-content">




                <!-- edit settings -->
                <div class="tab-pane active" id="settings" role="tabpanel">
                    <br>
                    <h2>Edit Your Settings</h2>
                    <br>
                    <form>

                    <div class="form-group row">
                        <label for="University" class="col-2 col-form-label">University</label>
                        <div class="col-6">
                            <input class="form-control"  placeholder="Insert Your University" type="text" name="university">
                        </div>
                    </div>


                        <div class="form-group row">
                            <label for="example-search-input" class="col-2 col-form-label">Fav hobby</label>
                            <div class="col-6">
                                <input class="form-control" placeholder="Insert Your Hobbies" type="text" name="hobbies"  >
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="example-tel-input" class="col-2 col-form-label">Telephone</label>
                            <div class="col-6">
                                <input class="form-control" type="tel" placeholder="Insert Your Phone Number Here" name="phone" id="example-tel-input">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-tel-input" class="col-2 col-form-label">Tags</label>
                            <div class="col-6">
                                <input class="form-control" placeholder="Insert Your Skills Here" type="tag" name="tags" id="example-tel-input">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-tel-input" class="col-2 col-form-label">Date of birth</label>
                            <div class="col-6">
                                <input class="form-control" type="date" name="DOB" id="example-tel-input">
                            </div>
                        </div>

                        <div class="form-inline ">
                            <label for="example-Degree-input" class="col-2 col-form-label">Degree</label>


                            <select class="form-control" name="degree">

                                <option value="Bachelor">Bachelor</option>
                                <option  value="Masters">Masters</option>
                                <option  value="PHD">PHD</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleTextarea">About</label>
                            <textarea class="form-control" id="exampleTextarea" rows="6" name="about"> Tell us About you!</textarea>
                        </div>

                        <button class="btn btn-primary">Submit</button>



                    </form>

                </div>



                <div class="tab-pane" id="Articles1" role="tabpanel">.
                    <br>
                    <h2>Your Articles</h2>
                    <br>

                    <table class="table table-striped text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Article Title</th>
                            <th>Comments</th>
                            <th>Schadule Time</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row text-center">1</th>
                            <td>How to have sex</td>
                            <td>5</td>
                            <td>12/12/2012 12:30</td>
                            <td> <button class="btn btn-secondary ">View</button>  <button class="btn btn-primary">Edit</button> <button class="btn btn-danger">Delete</button></td>
                        </tr>
                        <tr>
                            <th scope="row text-center">2</th>
                            <td>German 4</td>
                            <td>5</td>

                            <td>12/12/2012 12:30</td>
                            <td> <button class="btn btn-secondary ">View</button>  <button class="btn btn-primary">Edit</button> <button class="btn btn-danger">Delete</button></td>
                        </tr>
                        <tr>
                            <th scope="row text-center">3</th>
                            <td>Caculus 2</td>
                            <td>5</td>

                            <td>12/12/2012 12:30</td>
                            <td> <button class="btn btn-secondary ">View</button>  <button class="btn btn-primary">Edit</button> <button class="btn btn-danger">Delete</button></td>
                        </tr>
                        </tbody>
                    </table>
                </div>




                <!-- My Answers -->
                <div class="tab-pane" id="myAnswers" role="tabpanel">
asfasf
                </div>

                <!-- My questions -->
                <div class="tab-pane" id="myQuestions" role="tabpanel">
asfasfasfa
                </div>

                <!-- my courses table -->
                <div class="tab-pane" id="myCourses" role="tabpanel">

                    <br>
                    <h2>My courses</h2>
                    <br>
                    <table class="table table-striped text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Course Name</th>
                            <th>Capicity</th>
                            <th>Price Per Houre</th>

                            <th>Schadule Time</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row text-center">1</th>
                            <td>Arabic 1</td>
                            <td>5</td>
                            <td>7 JD</td>

                            <td>12/12/2012 12:30</td>
                            <td> <button class="btn btn-secondary ">View</button>  <button class="btn btn-danger">Leave</button></td>
                        </tr>
                        <tr>
                            <th scope="row text-center">2</th>
                            <td>German 4</td>
                            <td>5</td>
                            <td>7 JD</td>

                            <td>12/12/2012 12:30</td>
                            <td><button class="btn btn-secondary ">View</button>  <button class="btn btn-danger">Leave</button></td>
                        </tr>
                        <tr>
                            <th scope="row text-center">3</th>
                            <td>Caculus 2</td>
                            <td>4</td>
                            <td>3 JD</td>

                            <td>12/12/2012 12:30</td>
                            <td><button class="btn btn-secondary ">View</button>  <button class="btn btn-danger">Leave</button></td>
                        </tr>
                        </tbody>
                    </table>

                </div>





                <!--offered courses Table-->
                <div class="tab-pane" id="OfferedCourses" role="tabpanel"> <br>
                    <h2> Your Offered Courses</h2>
                    <br>
                    <table class="table table-striped text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Course Name</th>
                            <th>Capicity</th>
                            <th>Price Per Houre</th>
                            <th>Students Registered</th>
                            <th>Schadule Time</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row text-center">1</th>
                            <td>German 4</td>
                            <td>5</td>
                            <td>7 JD</td>
                            <td>2</td>
                            <td>12/12/2012 12:30</td>
                            <td><button class="btn btn-success ">Done</button> <button class="btn btn-secondary ">View</button>    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal1">Kick</button> <button class="btn btn-primary">Cancel</button></td>
                        </tr>
                        <tr>
                            <th scope="row text-center">2</th>
                            <td>German 4</td>
                            <td>5</td>
                            <td>7 JD</td>
                            <td>2</td>
                            <td>12/12/2012 12:30</td>
                            <td><button class="btn btn-success ">Done</button>  <button class="btn btn-secondary ">View</button> <button class="btn btn-danger">Kick</button> <button class="btn btn-primary">Cancel</button></td>
                        </tr>
                        <tr>
                            <th scope="row text-center">3</th>
                            <td>German 2</td>
                            <td>4</td>
                            <td>3 JD</td>
                            <td>3</td>
                            <td>12/12/2012 12:30</td>
                            <td><button class="btn btn-success ">Done</button>  <button class="btn btn-secondary ">View</button> <button class="btn btn-danger">Kick</button> <button class="btn btn-primary">Cancel</button></td>
                        </tr>
                        </tbody>
                    </table></div>




            </div>



            <!--<table id="myTable1">
                <tr class="header">
                    <th ><h2>Offered Courses</h2></th>

                </tr>
                <tr>
                    <td>
                        <div class="row" style="margin-top: 10px; padding-left: 20px;">

                            <div class="col-md-1">
                                <i class=" fa fa-star fa-2x"></i>
                            </div>

                            <div class="col-md-4">
                                <span> <h3 class="text-center">CourseName <br> German 4</h3></span>
                            </div>

                            <div class="col-md-3">
                                <h3 class="text-center"><i class="fa fa-users fa-2x" aria-hidden="true"></i><br> 2</h3>
                            </div>

                            <div class="col-md-4">
                                <h3 class="text-center"><i class="fa fa-money fa-2x" aria-hidden="true"></i><br> 7JD</h3>
                            </div>
                        </div>
                        <br>
                        <!---      <h3 style="padding-left: 26px;">Registered Students:</h3>
                     <div class="row studentstable ">

                             <div class="col-md-12">


                                             <table class="table table-striped">
                                                 <thead>
                                                 <tr>
                                                     <th>#</th>
                                                     <th>First Name</th>
                                                     <th>Email</th>
                                                     <th>Action</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody>
                                                 <tr>
                                                     <th scope="row">1</th>
                                                     <td>Saif Hallaq</td>
                                                     <td>Mark@outlook.com</td>
                                                     <td><button class="btn-danger">Kick</button> </td>
                                                 </tr>

                                                 <tr>
                                                     <th scope="row">1</th>
                                                     <td>Saif Hallaq</td>
                                                     <td>Mark@outlook.com</td>
                                                     <td><button class="btn-danger">Kick</button> </td>
                                                 </tr>

                                                 <tr>
                                                     <th scope="row">1</th>
                                                     <td>Saif Hallaq</td>
                                                     <td>Mark@outlook.com</td>
                                                     <td><button class="btn-danger">Kick</button> </td>
                                                 </tr>

                                                 <tr>
                                                     <th scope="row">1</th>
                                                     <td>Saif Hallaq</td>
                                                     <td>Mark@outlook.com</td>
                                                     <td><button class="btn-danger">Kick</button> </td>
                                                 </tr>

                                                 </tbody>
                                             </table>




                                         </div>



                            </div>


                        </div>
        <div class="deletebtn">
            <button class="btn btn-primary float-right">Done</button>
        </div>

        <div class="donebtn">
            <button class="btn btn-danger float-right">Cancel</button>
        </div>

-->
        <li class="ReviewsSection">
<hr>
            <h3> <li class="fa fa-star fa-2x">Your Rating And Reviews  </h3></li>
<br>
                <div class="row">
                    <div class="col-md-7">

         <div id="ratingbox">

             <div class="row">
                 <div class="col-md-3 text-center">
                     <b>Muntaser Mraisi</b><br>

                         <div class="article-stars1 text-center">

                             <div class="review-block-rate text-center">

                                 <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                 <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                 <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                 <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                 <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                             </div></div>
                 </div>
                 <div class="col-md-8 text-center bold">

                     "Your are really nice guy la allah fhmeet 3alek. bs lazem tsawe haik w haik w haikklsdjflksdjflskdj"
                 </div>
             </div>

             </div>
            <br>



            <div id="ratingbox">

                <div class="row">
                    <div class="col-md-3 text-center">
                        <b>Muntaser Mraisi</b><br>

                        <div class="article-stars1 text-center">

                            <div class="review-block-rate text-center">

                                <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                            </div></div>
                    </div>
                    <div class="col-md-6 text-center bold">

                        "Your are really nice guy la allah fhmeet 3alek. bs lazem tsawe haik w haik w haikklsdjflksdjflskdj"
                    </div>
                </div>

            </div>


<br>

            <div id="ratingbox">

                <div class="row">
                    <div class="col-md-3 text-center">
                        <b>Muntaser Mraisi</b><br>

                        <div class="article-stars1 text-center">

                            <div class="review-block-rate text-center">

                                <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                                <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                            </div></div>
                    </div>
                    <div class="col-md-8 text-center bold">

                        "Your are really nice guy la allah fhmeet 3alek. bs lazem tsawe haik w haik w haikklsdjflksdjflskdj"
                    </div>
                </div>

            </div>

            </div>
                    <div class="col-md-5">
                       ldksmflksdmq

                    </div>





        </div>


        </div>


        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Registered Students</h4>
            </div>
            <div class="modal-body">
                <div class="row studentstable ">

                    <div class="col-md-12">


                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Saif Hallaq</td>
                                <td>Mark@outlook.com</td>
                                <td><button class="btn-danger">Kick</button> </td>
                            </tr>

                            <tr>
                                <th scope="row">1</th>
                                <td>Saif Hallaq</td>
                                <td>Mark@outlook.com</td>
                                <td><button class="btn-danger">Kick</button> </td>
                            </tr>

                            <tr>
                                <th scope="row">1</th>
                                <td>Saif Hallaq</td>
                                <td>Mark@outlook.com</td>
                                <td><button class="btn-danger">Kick</button> </td>
                            </tr>

                            <tr>
                                <th scope="row">1</th>
                                <td>Saif Hallaq</td>
                                <td>Mark@outlook.com</td>
                                <td><button class="btn-danger">Kick</button> </td>
                            </tr>

                            </tbody>
                        </table>




                    </div>

                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
</div>




    <?php
    include_once ("../project/Footer.php");
    ?>


</body>
</html>