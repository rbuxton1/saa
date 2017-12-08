<?php
  include('../dash/config.php');
?>
<html>
  <body>
    <center>
      <?php
        $id = $_GET['id'];

        if($id != 0){
          $stmt = "SELECT * FROM liveArt WHERE id = '$id'";
          $sql = mysqli_query($db, $stmt);
          if($sql){
            $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);
            $imgSrc = $row['src'];

          }

          echo("<img src = '../uploads/" . $row['src'] . "'>");
        }
      ?>
    </center>
  </body>
</html>
