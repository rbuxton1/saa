<?php
  include('config.php');
?>
<html>
  <body>
    <center>
      <?php
        if(isset($_POST['id'])){
          $id = $_POST['id'];
          $stmt = "SELECT * FROM liveArt WHERE id = '$id'";
          $sql = mysqli_query($db, $stmt);
          if($sql){

          }
        }
      ?>
    </center>
  </body>
</html>  
