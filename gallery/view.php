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
            $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);
            $imgSrc = $row['src'];

          }

          echo("<img src = '$imgSrc'></img>");
        }
      ?>
    </center>
  </body>
</html>
