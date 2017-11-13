<?php
  include("config.php");

  $hashPass = hash('sha256', "stank");
  $sql = "INSERT INTO user (id, email, password) values (NULL, 'cheez', '$hashPass')";
  $result = mysqli_query($db,$sql);
  if($result){
    echo "inserted";
  } else {
    echo "error " . $result;
  }
?>
