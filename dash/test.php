<?php
  include("config.php");

  if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $sql = "INSERT INTO user (id, email, password) values (NULL, 'squee', 'scmhee')"
  $result = mysqli_query($db,$sql);
  if($result){
    echo "yeah";
  } else{
    echo "nah";
  }
?>
