<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Question and Answer</title>

    <!-- Bootstrap core CSS -->
    <?php
    include_once("header1.php")
    ?>

    <script>
        function textAreaAdjust(o) {
            o.style.height = "1px";
            o.style.height = (25+o.scrollHeight)+"px";
        }

    </script>
</head>

<body>
<?php
include_once('header.php');

?>
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-8">
                    <div class="ArticleTitle">
                        <h1><input type="text" value="Article Title " name=""></h1>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="votes float-right">
                        Date Of creation
                    </div>
                </div>

            </div>

            <div class="Article-body">
                 <textarea cols="80" rows="10" onkeyup="textAreaAdjust(this)" style="overflow:hidden">
                There’s no getting around it – our bodies change as we approach middle age. Along with the appearance of grey hair and laugh lines, our metabolism begins to slow down as early as our late twenties. This shift tends to begin around the same time we settle into our careers and start families, leaving little time for healthy meal prep and exercise.

                Unfortunately, our metabolism continues to drop roughly one to two percent each decade thereafter. This makes it tricky to lose weight and keep it off even when we’re good about hitting the gym a few days a week. However, staying in shape after 40 isn’t as hard as we think. Research shows that how we workout can make a big difference between so-so results and staying in excellent health for years to come.

                WHAT HAPPENS TO OUR BODIES AFTER 40?

                Around the age of 40, inactive adults begin to lose muscle mass through a natural process called sarcopenia. As we lose muscle, our metabolism slows down even more, and our muscle is replaced by fat.

                Though you may not see a huge difference on the scale, you may notice that your clothes fit differently. While a pound of muscle weighs the same as a pound of fat, fat is “fluffier” and takes up more space in the body. The good news: working out not only burns fat for a slimmer physique, it can also help ward off some serious health conditions.

                WORKING OUT AFTER 40

                Strength training<br>

                While any type of activity will burn calories, strength training is especially effective at slowing the loss of muscle mass and keeping your metabolism in high gear. According to research from the Harvard School of Public Health, adults who lift weights put on less belly fat as they age than those who coast at a steady pace on the treadmill or elliptical (though cardio is important, too).

                Aim for two to three strength training sessions per week to sculpt lean muscles and prevent the chronic joint pain and stiffness associated with arthritis. Oh, and you don’t have to spend hours in the weight room to reap the benefits. According to personal trainer Holly Perkins, “All you really need to do is some form of a squat, deadlift, and overhead press to strengthen multiple joints and muscles.”

                Cardio<br>

                While research shows that strength training is most effective for building muscle and burning fat, it’s important not to neglect your treadmill. As the name implies, cardiovascular exercise keeps your heart muscle strong, which becomes increasingly important with age. According to a National Health and Nutrition Examination Survey, the frequency of coronary heart disease is nearly 10 times higher in women over 40 than it is in women between the ages of 20 and 39.

                To benefit from your cardio workouts, exercise at 80 percent of your maximum heart rate for at least 30 minutes, three to four times per week. In other words, if you’re not breaking a sweat in your Zumba class, it’s time to kick your effort up a notch.

                Flexibility<br>

                The third pillar to a well-rounded exercise regimen is flexibility training. Keeping your muscles limber will improve your balance and help reduce injuries. Dynamic stretching is preferred (think walking lunges, squats, and arm circles) as it lets you work on your flexibility and balance all at once. Foam rolling also increases flexibility while breaking up painful trigger points in your muscles and promoting healthy blood flow.
                     <hr></textarea>
            </div>
            <input type="submit" class="btn btn-danger" value="edit" style="width: 150px">
        </div>

        <div class="col-md-3 col-sm-1">
            <div class="conatiner">
                <div class="card cardowner">
                    <div class="card-header">
                        Article Owner
                    </div>

                    <img src="img/img_avatar1.png"  class="ownerimage rounded-circle">
                    <div class="card-body text-center">
                        <h4 class="card-title-1">John Doe</h4>
                    </div>
                    <div class="article-stars1 text-center">

                        <div class="review-block-rate">

                            <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                            <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                            <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                            <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                            <span class="fa fa-star fa-2x" aria-hidden="true"></span>

                        </div></div>

                    <a href="#" class="btn btn-primary">See Profile</a>
                </div>
            </div>
            <br>
            <div class="card relatedarticles">
                <div class="card-header">
                    Related Articles
                </div>
                <div class="card-body">
                    <ul>

                        <li><a href="#">Link</a> </li>
                        <li><a href="#">Link</a> </li>
                        <li><a href="#">Link</a> </li>
                        <li><a href="#">Link</a> </li>
                        <li><a href="#">Link</a> </li>


                    </ul>
                </div>
            </div>


        </div>
    </div>
</div>



</div>






<!-- Footer -->
<footer class="py-5 bg-dark myfooter">
    <div class="container">
        <p class="m-0 text-center text-white">LEEO</p>
    </div>


</body>
</html>