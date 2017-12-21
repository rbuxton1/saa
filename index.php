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
      <div class="w3-center">
        <h4>SAA <?php echo $version; ?></h4>
        <a href="index.php"><h1 class="w3-xxxlarge w3-animate-top">STUDENT ART ARCHIVE</h1></a>
        <div class="w3-padding-32">
          <button class="w3-btn w3-xlarge w3-dark-grey w3-hover-light-grey" onclick="location.href='dash/login.php'" style="font-weight:900;">LOGIN</button> <br> <br>
          <button class="w3-btn w3-xlarge w3-dark-grey w3-hover-light-grey" onclick="location.href='gallery/gallery.php'" style="font-weight:900;">GALLERY</button>
        </div>
      </div>
    </header>
    <hr><br>

    <!-- Body -->
    <div class="w3-center">
      <img src="assets/saa2.png" alt="SAA" style="width:50%">
      <p class="w3-large">
        SAA by by Curtis Worthy and Ryan Buxton is a database meant to help students show off the work that they create at OHS in the visual arts program. It will be a online portfolio for them to share their work off to friends and family. It has been developed for the 2017-18 school year for Computer Science Senior Project. It is a PHP and HTML front end on a Ubuntu server running Apache2 and MySQL. More about the project, along with a wiki incase you want to set up your own copy for a school or institution or even for a personal works database, can be found <a href="https://github.com/rbuxton1/saa">here</a>. The system is free to use and is designed to be as versitile as possible. Until otherwise stated, the project is considered a work in progress, so there will be updates in the future.
      </p>
    </div>
    <br>

    <hr>
    <div class="w3-center">
      <p class="w3-large">
        Some random works from SAA!
      </p>
    </div>
    <div class="w3-row w3-border">
      <div class="w3-third w3-container w3-red w3-animate-left">
        <p>
          <?php
            $req = "SELECT * FROM liveArt ORDER BY RAND() LIMIT 1";
            $sql = mysqli_query($db, $req);
            $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);
            echo "<a href='/gallery/view.php?id=" . $row['id'] . "'><img src='uploads/" . $row['src'] . "' alt='Missing image?' style='width:100%' class='w3-hover-opacity'></a><br>";
            echo "<i>" . $row['title'] . "</i> by " . $row['artist'];
          ?>
        </p>
      </div>
      <div class="w3-third w3-container w3-blue w3-animate-bottom">
        <p>
          <?php
            $req = "SELECT * FROM liveArt ORDER BY RAND() LIMIT 1";
            $sql = mysqli_query($db, $req);
            $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);
            echo "<a href='/gallery/view.php?id=" . $row['id'] . "'><img src='uploads/" . $row['src'] . "' alt='Missing image?' style='width:100%' class='w3-hover-opacity'></a><br>";
            echo "<i>" . $row['title'] . "</i> by " . $row['artist'];
          ?>
        </p>
      </div>
      <div class="w3-third w3-container w3-green w3-animate-right">
        <p>
          <?php
            $req = "SELECT * FROM liveArt ORDER BY RAND() LIMIT 1";
            $sql = mysqli_query($db, $req);
            $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);
            echo "<a href='/gallery/view.php?id=" . $row['id'] . "'><img src='uploads/" . $row['src'] . "' alt='Missing image?' style='width:100%' class='w3-hover-opacity'></a><br>";
            echo "<i>" . $row['title'] . "</i> by " . $row['artist'];
          ?>
        </p>
      </div>
    </div>
    <hr>



    <!-- Footer -->
    <footer class="w3-container w3-theme-dark w3-padding-16">
      <p>
        <div class="w3-center">
          Student Art Archive version 1.0.0 &emsp; <a href="https://github.com/rbuxton1/saa/wiki">Built and maintained by Ryan Buxton and Curtis Worthy</a> &emsp; Senior Project 2017-2018 OHS <br>
          Theme by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a>
          <br> <br>
          <i> SAA, dude! </i>
        </div>
      </p>
      <div style="position:relative;bottom:55px;" class="w3-tooltip w3-right">
        <span class="w3-text w3-theme-light w3-padding">Go To Top</span> 
        <a class="w3-text-white" href="#myHeader"><span class="w3-xlarge">
        <i class="fa fa-chevron-circle-up"></i></span></a>
      </div>
    </footer>
  </body>
</html>
