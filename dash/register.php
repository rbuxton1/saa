<? php
  include("config.php");
  session_start();

  $msg = "";
  $error = false;

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($db,$_POST['username']);
    $pass = mysqli_real_escape_string($db,$_POST['password']);
    $comPass = mysqli_real_escape_string($db,$_POST['password2']);

    $sql = "SELECT * from user where email = '$username'";
    $result = mysqli_query($db,$sql);
    if(0 != mysqli_num_rows($result)){
      $msg .= "Username already used.";
      //Add test to see if its an email
    } else{
      if(pass != comPass){
        $msg .= "Passwords do not match.";
      } else {
        $hashPass = hash('sha256', $password);
        $sql = "INSERT INTO user (id, email, password) values (NULL, '$username', '$hashPass')";
        $result = mysqli_query($db,$sql);
        if($result){
          $msg = "succ";
        }
      }
    }
    echo $msg;
    //echo $username . ' ' . $pass .' ' . $sql;
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
  </center>
</html>
