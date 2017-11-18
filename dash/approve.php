<?php
  include('session.php');
  include('config.php');
  session_start();


  //basic data about guest
  $user = $_SESSION['login_user'];

  $req = "SELECT * FROM user WHERE email = '$user'";
  $sql = mysqli_query($db, $req);
  $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);
  $isAdmin = $row['admin'];

  if($isAdmin == 0) header("Location: login.php"); //kicks out non-admins
?>
