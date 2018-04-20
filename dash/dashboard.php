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

?>
<html>
  <title>SAA Dash</title>
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
        <a href="../index.php"><h1 class="w3-xxxlarge w3-animate-top">STUDENT ART ARCHIVE</h1></a>
        <div class="w3-padding-32">
          <button class="w3-btn w3-xlarge w3-dark-grey w3-hover-light-grey" onclick="location.href='<?php echo("../gallery/view.php?artist=".$user) ?>'" style="font-weight:900;">GALLERY PAGE</button>
          <?php if($isAdmin == 1) echo '<button class="w3-btn w3-xlarge w3-dark-grey w3-hover-light-grey" onclick="'. "location.href='approve.php'" . '"s style="font-weight:900;">APPROVE/DENY</button>'; ?>
          <button class="w3-btn w3-xlarge w3-dark-grey w3-hover-light-grey" onclick="location.href='logout.php'" style="font-weight:900;">LOGOUT</button>
        </div>
      </div>
    </header>

      <!-- Body -->
      <div class="w3-center w3-container">
        <h1 class='w3-xlarge'> Welcome, <?php echo $user; ?>! </h1>
        <p class="w3-large">
          <center>
            <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
              <table>
                <tr>
                  <td>Select image to upload</td> <td><input type="file" name="fileToUpload" id="fileToUpload" class="w3-button"></td>
                </tr><tr>
                  <td><label>Title</label></td> <td><input placeholder="My first art" type="text" name="title" class="w3-input"></td>
                </tr><tr>
                  <td><label>Description</label></td> <td><textarea placeholder="Whats cool about this image?" rows="3" maxlength="500" name="data" class="w3-input"></textarea></td>
                </tr><tr>
                  <td><label>Tags</label></td>
                  <td>
                    <div class="w3-row">
                      <?php
                        $raw = file_get_contents("tags.txt");
                        $boys = explode(",", $raw);
                        $c = 1;
                        foreach($boys as $line) {
                          if(c < 3){
                            echo '<input class="w3-check" type="checkbox" name="' . $line .'"><label>' . $line . '</label>';

                          }
                          if ($c == 3) {
                            echo '</div><div class="w3-row">';
                            $c = 0;
                          }
                          $c = $c + 1;
                        }
                      ?>
                    </div>
                  </td>
                </tr>
              </table>
              <input type="submit" value="Upload Image" name="submit" class="w3-button w3-dark-grey w3-hover-light-grey">
            </form>
          </center>
          <?php
          include('config.php');

          function generateRandomString($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
              $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
          }

          $name = $_SESSION['login_user'];
          $title = $_POST['title'];
          $data = $_POST['data'];
          $tags = "";
          foreach ($_POST as $key => $value){
            if($value == "on"){
              $tags .= $key . ",";
            }
          }
          $tags = substr($tags, 0, -1);

          //clean out the garbage
          $title = preg_replace("/[^a-zA-Z0-9\s]/", "", $title);
          $data = preg_replace("/[^a-zA-Z0-9\s]/", "", $data);

          $target_dir = str_replace("dash","",getcwd()). "uploads/";
          $source = generateRandomString(). "." . end((explode(".", $_FILES["fileToUpload"]["name"]))); // basename($_FILES["fileToUpload"]["name"])

          $uploadOk = 1;

          $target_file = $target_dir . $source; //$source;
          $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

          // Check if image file is a actual image or fake image
          if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) { //was !==
              $uploadOk = 1;
              echo "File is an image - (<i>" . $check["mime"] . " (" . $check . ")</i>).";
            } else {
              echo "<div class='w3-red'>File is not an image.</div>";
              $uploadOk = 0;
            }

            // Check if file already exists
            if (file_exists($target_file)) {
              echo "<div class='w3-red'>Please try again.</div>";
              $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
              echo "<div class='w3-red'>Sorry, your file was not uploaded.</div>";
            } else {
              $possibleError = move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
              echo $target_file;
              if ($possibleError) {
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded to the server... ";

                $sql = "INSERT INTO pendingArt (id, title, src, tags, rate, artist, data) VALUES (NULL, '$title', '$source', '$tags', NULL, '$name', '$data')";
                $result = mysqli_query($db,$sql);

                //TODO: give these colors, make them look fancy.
                if($result){
                  echo "<div class='w3-green'>and was uploaded to database!</div>";
                  header("Refresh:1");
                } else {
                  echo "<div class='w3-red'>however failed to get to the database. ERR: " . (string($result)) . "</div>";
                  header("Refresh:1");
                }
              } else {
                echo "<div class='w3-red'> Sorry, there was an error uploading your file. ERR: (" . ((string)$possibleError) . ")</div><br>";
                header("Refresh:10");
              }
            }
          }
          ?>

      <hr>
      <p class+'w3-large'>
        <center>
          <?php
            $req = "SELECT * FROM pendingArt WHERE artist = '$user'";
            $sql = mysqli_query($db, $req);
            if(mysqli_num_rows($sql) > 0){
              echo '<h2 class="w3-large"> Works waiting to be approved and rated by ' . $user .'</h2> <br>
              <table class="w3-table w3-border w3-striped w3-bordered">
                <tr><th>Image</th> <th>Title</th> <th>Tags</th> <th>Extra Data</th></tr>';
            }
            while($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
              echo "<tr>";
              echo "<td> <center> <img src = '../uploads/" . $row['src'] . "' style ='height:300px; width:auto;'>" . "</center></td>";
              echo "<td><center>" . $row['title'] . "</center></td>";
              echo "<td><center>" . $row['tags'] . "</center></td>";
              echo "<td><center>" . $row['data'] . "</center></td>";
              echo "</tr>";
            }
            echo "</table>";
          ?>
          </table>
        </center>
      </p>
    </div>

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
