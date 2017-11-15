<?php
  include("config.php");
  session_start();

  $msg = "";
  $error = false;

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['username']);
    $pass = trim($_POST['password']);
    $comPass = trim($_POST['password2']);

    $error = false;
    $errorMsg = "";

    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $error = true;
        $errorMsg .= "Please enter a real email. ";
    } else {
        $query = "SELECT email FROM user WHERE email='$email'";
        $result = mysqli_query($db,$query);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        if($count != 0){
            $error = true;
            $errorMsg .= "Email is already in use. ";
        }
    }

    if($pass != $comPass){
      $error = true;
      $errorMsg .= "Passwords do not match. ";
    }

    if(!$error){ //NO error
      $hashedPass = hash('sha256', $password);

      $query = "INSERT INTO user (id, email, password) VALUES (NULL, '$email', '$hashedPass')";
      $result = mysqli_query($db,$query);

      if($result){
          $errorMsg = "Sucsess";
          unset($name);
          unset($password);
          unset($email);
          unset($confirm);
          unset($hashedPass);
      } else {
          $errorMsg = "Failure" . ((string)$result) . ": " . $query;
      }
    }
  }
?>
<html>
  <head>

  </head>
  <center>
    <h1> SAA Register </h1>
    <p> register </p>
    <form action = "" method = "post">
      <label>Email  :</label><input type = "text" name = "username" class = "box"/><br /><br />
      <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
      <label>Password  :</label><input type = "password" name = "password2" class = "box" /><br/><br />
      <input type = "submit" value = " Submit "/><br />
    </form>
    <p> <?php echo $errorMsg; ?> </p>
  </center>
</html>
