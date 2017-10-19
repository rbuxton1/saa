<?php
  include("config.php");
  $sql = "INSERT INTO user (id, email, password) values (NULL, 'squee', 'scmhee')"
  $result = mysqli_query($db,$sql);
  if($result){
    echo "yeah";
  } else{
    echo "nah";
  }
?>
