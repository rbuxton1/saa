<?php
  include('session.php');
  include('config.php');
  session_start();


  //basic data about guest
  $user = $_SESSION['login_user'];
?>
<html>
  <head>
    <title> SAA Dashboard </title>
  </head>
  <body>
    <center>
      <h1> Welcome, <?php echo $user; ?> ! </h1>
      <p>
        Click <a href="logout.php">here</a> to log out. <br>
        <br>
        Include upload form here
      </p>
      <hr
      <p>
        Uploaded works by this artist here
      </p>
    </center>
  </body>
</html>
