<?php
  include("dash/config.php");
?>
<html>
  <head>
    <title>SAA Main Page</title>
  </head>
  <body>
    <center>
      <img src="assets/saa.png"></img> <br>
      <i><?php echo "SAA " . $version; ?></i>
      <br> <br> <br>

      <p>
        <a href="/dash/login.php">Login page test</a> <br>
        <a href="/dash/register.php">Register page test</a> <br>
        <a href="/gallery/view.php">Gallery page test</a>
        <hr>
        Student Art Archive version 1.0.0 &emsp;
        <a href="https://github.com/rbuxton1/saa/wiki">Built and maintained by Ryan Buxton and Curtis Worthy</a> &emsp;
        Senior Project 2017-2018 OHS
      </center>
    </body>
</html>
