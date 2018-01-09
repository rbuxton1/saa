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
  <div class="w3-display-container">
    <div class="w3-display-middle w3-card">
      <form action = "" method = "post">
        <div class="w3-black">
          <img src="../assets/saa2.png" alt="SAA" style="width:50%">
          <p class="w3-small">SAA login</p>
        </div>
        <label>Username</label><input type="text" name="username" class="w3-input">
        <label>Password</label><input type="password" name="password" class="w3-input">
        <input type = "submit" value = "Login" class="w3-btn w3-xlarge w3-dark-grey w3-hover-light-grey">
      </form>
      <footer class="w3-container w3-black">
        Click <a href="../index.php">here</a> to back out to the main page. <br>
        Click <a href="register.php">here</a> to register for an account. <br>
      </footer>
    </div>
  </div>
</html>
