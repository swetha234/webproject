<?php
session_start();
include "session.php";
if(!isset($_SESSION['email'])){
    
    header("location: index.php");
    
}
?>
<html>
  <head>
       <link rel= "stylesheet" href="style/home_style.css" media ="all"/>
    <style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
       <div id= "head_wrap">
            <div id="header">
                <ul id="menu">
                <li><a href="home.php">Home</a></li>
                <li><a href="members.php">Members</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="help.php">Help</a></li>
                    
                </ul>
            </div>
        </div>
  <h1 align="center"><b>Need some help ??</b></h1>
      <div class="container ">
      <div class="panel-group" id="faqAccordion">
          <div class="panel panel-default ">
                <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question0">
                <h4 class="panel-title">
                    <a href="#" class="ing">Q: what is this site for?</a>
              </h4>
            </div>
            <div id="question0" class="panel-collapse collapse" style="height: 0px;">
                <div class="panel-body">
                     <h4><span class="label label-primary">Answer</span>
                    <p><br>Pet Finder lets you browse through tons of puppy profiles and you can share and save your favorites. One of the coolest features is that the app recognizes the kinds of profiles you're most interested in, and it gives you more suggestions.
                      <br>  You can take some tips from others if your new to raising a pet. 
                    </p></h4>
                </div>
            </div>
        </div>
         <div class="panel panel-default ">
            <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question1">
                 <h4 class="panel-title">
                    <a href="#" class="ing">Q: Why should we use it?</a>
              </h4>

            </div>
            <div id="question1" class="panel-collapse collapse" style="height: 0px;">
                <div class="panel-body">
                     <h4><span class="label label-primary">Answer</span>
                    <p><br>Looking for information about which kind of pet best fits your lifestyle or troubleshooting a pressing concern, pet resources on the web are top-notch and tailored to whatever species you are interested in learning more about.
                    </p></h4>
                </div>
            </div>
        </div>
        <div class="panel panel-default ">
            <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question2">
                 <h4 class="panel-title">
                    <a href="#" class="ing">Q: How to register/login?</a>
              </h4>

            </div>
            <div id="question2" class="panel-collapse collapse" style="height: 0px;">
                <div class="panel-body">
                     <h4><span class="label label-primary">Answer</span>
                    <p><br>As you have made a decision to be a part of Petfinder you have to register for this with a E-mailid, password and fulfill some of the basic requirements. 
                    <br> After you register you have to login with the credentials. You can see your profile page where you can add a picture of yours.
                    </p></h4>
                </div>
            </div>
        </div>
        <div class="panel panel-default ">
            <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question3">
                 <h4 class="panel-title">
                    <a href="#" class="ing">Q: How to ask/answer a question?</a>
              </h4>

            </div>
            <div id="question3" class="panel-collapse collapse" style="height: 0px;">
                <div class="panel-body">
                     <h4><span class="label label-primary">Answer</span>
                    <p><br>As soon as you login into the site you can see the most recent discussion you have made in the public and private groups. You can open the global group and post your opinions or ask doubts. You also have an option to select the topic of your choice and talk about it. 
                    </p></h4>
                </div>
            </div>
        </div>
        <div class="panel panel-default ">
            <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question4">
                 <h4 class="panel-title">
                    <a href="#" class="ing">Q: How to interact with others?</a>
              </h4>

            </div>
            <div id="question4" class="panel-collapse collapse" style="height: 0px;">
                <div class="panel-body">
                     <h4><span class="label label-primary">Answer</span>
                    <p><br>You can see the questions of other users posted by them in global group, and also can ask them some doubts beyond their question in their posts itself.
                    </p></h4>
                </div>
            </div>
        </div>
        <div class="panel panel-default ">
            <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question5">
                 <h4 class="panel-title">
                    <a href="#" class="ing">@: How to use tetxtarea?</a>
              </h4>

            </div>
            <div id="question5" class="panel-collapse collapse" style="height: 0px;">
                <div class="panel-body">
                     <h4><span class="label label-primary">Answer</span>

                    <p><br>Our textarea is made with summernote. This allows you to post all kinds of messages that include photos, URL's and codes in a pretty formatted way. </p></h4>
                </div>
            </div>
        </div>
    </div>

    <h3><b><u>Our Office Location</u></b></h3>
    <h4> Contact: (phone) +1 757-289-5997
        <br> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; (Fax) +1 111-2223334
        <br> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; address: 1055W,48th Street,Norfolk,VA-23508.</h4>
    <div id="map"></div>
    <script>
      function initMap() {
        var uluru = {lat: +36.8866884, lng: -76.3002960};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpJltk7G4M2douCfM_AdNzJvrHKyZh2uE&callback=initMap">
    </script>
    </div>
  </body>
</html>
