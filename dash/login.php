<?php
  include("config.php");
  session_start();
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $myusername = mysqli_real_escape_string($db,$_POST['username']);
    $mypassword = mysqli_real_escape_string($db,$_POST['password']);
    $hashpass = hash('sha256', $password);

    $sql = "SELECT id FROM user WHERE email = '$myusername' and password = '$hashpass'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $active = $row['active'];

    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if($count == 1) {
      $_SESSION['login_user'] = $myusername;
      header("location: dashboard.php");
    }else {
      $error = "Your Login Name or Password is invalid";
    }
  }
?>
<html>
  <head>

  </head>
  <center>
    <h1> SAA Login </h1>
    <p> login form here </p><br>
    Click <a href="../index.php">here</a> to back out to the main page. <br>
    Click <a href="register.php">here</a> to register for an account. <br>
    <form action = "" method = "post">
      <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
      <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
      <input type = "submit" value = " Submit "/><br />
    </form>
  </center>
</html>
