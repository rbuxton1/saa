<?php
  include("dash/config.php");
?>
​<html>
  <title>SAA</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
  <body>

    <!-- Header -->
    <header class="w3-container w3-theme w3-padding" id="myHeader">
      <i onclick="w3_open()" class="fa fa-bars w3-xlarge w3-button w3-theme"></i>
      <div class="w3-center">
        <h4>STUDENT ART ARCHIVE</h4>
        <h1 class="w3-xxxlarge w3-animate-bottom">SAA <?php echo $version; ?></h1>
        <div class="w3-padding-32">
          <button class="w3-btn w3-xlarge w3-dark-grey w3-hover-light-grey" onclick="location.href='dash/login.php'" style="font-weight:900;">LOGIN</button>
        </div>
      </div>
    </header>

    <hr>
    <div class="w3-row-padding w3-center w3-margin-top">
      <div class="w3-third"> </div>
      <div class="w3-third">
        <div class="w3-card">
          <img src="assets/saa.png" alt="SAA" style="width:100%">
        </div>
      </div>
      <div class="w3-third"> </div>
    </div>
    <br>
    <div class="w3-center">
      <p class="w3-large">
        SAA by by Curtis Worthy and Ryan Buxton is a database meant to help students show off the work that they create at OHS in the arts program.
      </p>
    </div>
    <br>

    <!-- Footer -->
    <footer class="w3-container w3-theme-dark w3-padding-16">
      <h3>Footer</h3>
      <p>
        Student Art Archive version 1.0.0 <br>
        <a href="https://github.com/rbuxton1/saa/wiki">Built and maintained by Ryan Buxton and Curtis Worthy</a> <br>
        Senior Project 2017-2018 OHS <br>
        Theme by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a>
      </p>
      <div style="position:relative;bottom:55px;" class="w3-tooltip w3-right">
        <span class="w3-text w3-theme-light w3-padding">Go To Top</span> 
        <a class="w3-text-white" href="#myHeader"><span class="w3-xlarge">
        <i class="fa fa-chevron-circle-up"></i></span></a>
      </div>
    </footer>
  </body>
</html>
