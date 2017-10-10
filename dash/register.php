<? php
  include("config.php");
  session_start();
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['username'];
    $pass = $_POST['password'];
    $comPass = $_POST['password2'];
    $error = '';

    $sql = "SELECT * from user where username = '$username'";
    $result = mysqli_query($db,$sql);
    if(0 != mysqli_num_rows($result)){
      $error = 'Username already used.<br>';
      //Add test to see if its an email
    } else{
      if(pass != comPass){
        $error .= 'Passwords do not match.<br>';
      } else {
        $hashPass = hash($password);
        $sql = "INSERT INTO user ('id', 'email', 'password') values (NULL, '$username', '$hashPass')"
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
  </center>
</html>
