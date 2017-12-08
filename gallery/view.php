<?php
  include('../dash/config.php');
?>
<html>
  <body>
    <center>
      <?php
        $id = $_GET['id'];
        $artist = $_GET['artist'];

        if($id != 0){
          $stmt = "SELECT * FROM liveArt WHERE id = '$id'";
          $sql = mysqli_query($db, $stmt);
          if($sql){
            $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);
            echo("
              <table border=0>
                <tr><img src = '../uploads/" . $row['src'] . "' style ='height:500px; width:auto;'></tr>
                <tr><p><i>" . $row['title'] . "<br>
                  By: " . $row['artist'] . "</i></p></tr>
                <tr><p>Description: <br> " . $row['data'] . " </p></tr>
              </table>");
          }
        }
        if($artist != null){
          echo("<h1>All art by " . $artist . "</h1><br><br><br>");
          $stmt = "SELECT * FROM liveArt WHERE artist = '$artist'";
          $sql = mysqli_query($db, $stmt);
          if($sql){
            while($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
              echo("
                <table border=0>
                  <tr><img src = '../uploads/" . $row['src'] . "' style ='height:500px; width:auto;'></tr>
                  <tr><p><i>" . $row['title'] . "<br>
                    By: " . $row['artist'] . "</i></p></tr>
                  <tr><p>Description: <br> " . $row['data'] . " </p></tr>
                </table>
                <hr>");
            }
          }
        }

      ?>
    </center>
  </body>
</html>
