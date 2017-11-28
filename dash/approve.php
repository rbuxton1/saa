<?php
  include('session.php');
  include('config.php');
  session_start();


  //basic data about guest
  $user = $_SESSION['login_user'];

  $req = "SELECT * FROM user WHERE email = '$user'";
  $sql = mysqli_query($db, $req);
  $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);
  $isAdmin = $row['admin'];

  if($isAdmin == 0) header("Location: login.php"); //kicks out non-admins
?>
<html>
  <body>
    <h1> Recent submissions </h1>
    <p>
      <center>
        <table border="1">
          <tr><th>Image</th> <th>Title</th> <th>Artist</th> <th>Tags</th> <th>Extra Data</th> <th>Rating</th> <th>Send to live</th></tr>
          <?php
            $req = "SELECT * FROM pendingArt";
            $sql = mysqli_query($db, $req);
            while($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
              echo "<tr>";
              echo "<td> <center> <img src = '../uploads/" . $row['src'] . "' style ='height:500px; width:auto;'>" . "</center></td>";
              echo "<td><center>" . $row['title'] . "</center></td>";
              echo "<td><center>" . $row['artist'] . "</center></td>";
              echo "<td><center>" . $row['tags'] . "</center></td>";
              echo "<td><center>" . $row['data'] . "</center></td>";
              $id = $row['id'];
              $myRating = "ratingValue" . $id;

              echo "<td><center>
                <form action = '' method = 'post'>
                  <input type = 'number' name = '$myRating' class='box'> </td>";
              echo "<td><center> <input type='submit' value='Upload'>
                <input type='hidden' name='id' value='$id'></form></td>";
              echo "</tr>";
            }
          ?>
        </table>
        <?php
          $msg = "!";

          if(isset($_POST['id'])){
            $okayID = $_POST['id'];
            $stmt = "SELECT * FROM pendingArt WHERE id ='$okayID'";
            $sql = mysqli_query($db, $stmt);
            $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);
            if($sql){
              $name = $row['title'];
              $source = $row['src'];
              $artist = $row['artist'];
              $tags = $row['tags'];
              $data = $row['data'];
              $rate = $_POST['ratingValue' . $okayID];

              $stmt = "INSERT INTO liveArt (id, title, src, tags, rate, artist, data)
                       VALUES (NULL, '$name', '$source', '$tags', '$rate', '$artist', '$data')";
              $sql = mysqli_query($db, $stmt);
              if($sql){
                $stmt = "DELETE FROM pendingArt WHERE id='$okayID'";
                mysqli_query($db, $stmt);
                header("Reload:0");
              }
            }

            //header("Reload:0");
          } else {
            echo "not sent: " . $msg;
          }
        ?>
      </center>
    </p>
  </body>
</html>
