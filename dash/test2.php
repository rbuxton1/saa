<? php
  include("config.php");

  $sql = "INSERT INTO user (id, email, password) values (NULL, '$username', '$hashPass')";
  $result = mysqli_query($db,$sql);
  if($result){
    echo "inserted";
  } else {
    echo "error " . $result;
  }
?>
