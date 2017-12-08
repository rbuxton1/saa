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

          echo("
            <table border=0>
              <tr><img src = '../uploads/" . $row['src'] . "' style ='height:500px; width:auto;'></tr>
              <tr><p><i>" . $row['title'] . " </i></p></tr>
              <tr><p><i>By " . $row['artist'] ." </p></i></tr>
              <tr><p>Description: <br> " . $row['data'] . " </p></tr> 
            ");
        }
      ?>
    </center>
  </body>
</html>
