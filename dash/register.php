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
      $hashedPass = hash('sha256', $pass);

      $query = "INSERT INTO user (id, email, admin, password) VALUES (NULL, '$email', '0', '$hashedPass')";
      $result = mysqli_query($db,$query);

      if($result){
          $errorMsg = "Sucsess. Click below to login!";
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
  </head>
  <div class="w3-display-container w3-light-grey" style="height:100%; width:100%">
    <div class="w3-display-middle">
      <div class="w3-center w3-card" style="width:300px;">
        <div class="w3-black">
          <p class="w3-xxlarge">SAA REGISTER</p>
        </div>
        <form action = "" method = "post">
          <label>Email</label><input type="text" name="username" class="w3-input">
          <label>Password</label><input type="password" name="password" class="w3-input">
          <label>Password confirmation</label><input type="password" name="password2" class="w3-input" >
          <input type = "submit" value = "Register Account" class="w3-btn w3-xlarge w3-dark-grey w3-hover-light-grey">
        </form>
        <p class="w3-large">
          <?php echo $errorMsg ?>
        </p>
        <footer class="w3-container w3-black">
          <a href="../index.php">Main Page</a><br>
          <a href="login.php">Login</a><br>
        </footer>
      </div>
    </div>
  </div>
</html>
