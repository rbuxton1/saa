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
  <title>SAA Approve</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
  <body>

    <!-- Header -->
    <header class="w3-container w3-theme w3-padding" id="myHeader">
      <div class="w3-center">
        <h4>SAA <?php echo $version; ?></h4>
        <a href="index.php"><h1 class="w3-xxxlarge w3-animate-top">STUDENT ART ARCHIVE</h1></a>
        <div class="w3-padding-32">
          <button class="w3-btn w3-xlarge w3-dark-grey w3-hover-light-grey" onclick="location.href='dashboard.php'" style="font-weight:900;">BACK</button>
          <button class="w3-btn w3-xlarge w3-dark-grey w3-hover-light-grey" onclick="location.href='logout.php'" style="font-weight:900;">LOGOUT</button>
        </div>
      </div>
    </header>

    <h1 class="w3-xlarge"> Recent submissions </h1>
    <p class="w3-center w3-large w3-container">
        <table class="w3-table w3-border w3-striped w3-bordered" style="width:100%;">
          <tr><th>Image</th> <th>Title</th> <th>Artist</th> <th>Tags</th> <th>Extra Data</th> <th>Rating</th> <th>Send to live</th></tr>
          <?php
            $req = "SELECT * FROM pendingArt";
            $sql = mysqli_query($db, $req);
            while($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
              echo "<tr>";
              echo "<td> <center> <img src = '../uploads/" . $row['src'] . "' style ='height:auto; width:300px;'>" . "</center></td>";
              echo "<td><center>" . $row['title'] . "</center></td>";
              echo "<td><center>" . $row['artist'] . "</center></td>";
              echo "<td><center>" . $row['tags'] . "</center></td>";
              echo "<td><center>" . $row['data'] . "</center></td>";
              $id = $row['id'];
              $myRating = "ratingValue" . $id;

              echo "<td><center>
                <form action = '' method = 'post'>
                  <input type = 'number' name = '$myRating' class='box'> <br>
                  <p>Possitive numbers to upload, <br> negative to remove.</p></td>";
              echo "<td><center> <input type='submit' value='Approve / Deny'>
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
              $ratingValueName = 'ratingValue' . $okayID;
              $rate = $_POST[$ratingValueName];

              if($rate >= 0){
                $stmt = "INSERT INTO liveArt (id, title, src, tags, rate, artist, data)
                          VALUES (NULL, '$name', '$source', '$tags', '$rate', '$artist', '$data')";
                $sql = mysqli_query($db, $stmt);
                if($sql){
                  $stmt = "DELETE FROM pendingArt WHERE id='$okayID'";
                  mysqli_query($db, $stmt);

                  header("Refresh:1");
                }
              } else {
                unlink(str_replace("dash","",getcwd()). "uploads/" . $source);
                $stmt = "DELETE FROM pendingArt WHERE src = '$source'";
                $sql = mysqli_query($db, $stmt);
                if($sql){
                  header("Refresh:1");
                }
              }
            }

            header("Refresh:1");
          } else {
          }
        ?>
      </center>
    </p>
    <!-- Footer -->
    <footer class="w3-container w3-theme-dark w3-padding-16">
      <p>
        <div class="w3-center">
          Student Art Archive version 1.0.0 &emsp; <a href="https://github.com/rbuxton1/saa/wiki">Built and maintained by Ryan Buxton and Curtis Worthy</a> &emsp; Senior Project 2017-2018 OHS <br>
          Theme by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a>
          <br> <br>
          <i> SAA, dude! </i>
        </div>
      </p>
      <div style="position:relative;bottom:55px;" class="w3-tooltip w3-right">
        <span class="w3-text w3-theme-light w3-padding">Go To Top</span> 
        <a class="w3-text-white" href="#myHeader"><span class="w3-xlarge">
        <i class="fa fa-chevron-circle-up"></i></span></a>
      </div>
    </footer>
  </body>
</html>
