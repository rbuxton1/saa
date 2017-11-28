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
  <head>
    <title> SAA Dashboard </title>
  </head>
  <body>
    <center>
      <h1> Welcome, <?php echo $user; ?>! </h1>
      <p>
        Click <a href="logout.php">here</a> to log out. <br>
        <?php if($isAdmin == 1) echo "Click <a href='approve.php'>here</a> to approve/deny recent image submissions." ?>
        <br>

        <form action="" method="post" enctype="multipart/form-data">
          Select image to upload:
          <input type="file" name="fileToUpload" id="fileToUpload">
          <label>Title </label><input type="text" name="title" class="box">
          <input type="submit" value="Upload Image" name="submit">
        </form>
        <?php
          include('session.php');
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
              echo "File is an image - (<i>" . $check["mime"] . "</i>). <br>";
            } else {
              echo "File is not an image.<br>";
              $uploadOk = 0;
            }

            // Check if file already exists
            if (file_exists($target_file)) {
              echo "Please try again. <br>";
              $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
              echo "Sorry, your file was not uploaded. <br>";
            } else {
              $possibleError = move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
              echo $target_file . "<br>";
              if ($possibleError) {
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded to the server... ";

                $sql = "INSERT INTO pendingArt (id, title, src, tags, rate, artist, data) VALUES (NULL, '$title', '$source', 'NO_TAG', NULL, '$name', NULL)";
                $result = mysqli_query($db,$sql);

                if($result){
                  echo 'and was uploaded to database! <br>';
                } else {
                  echo 'however failed to get to the database. ERR: ' . (string($result)) . "<br>";
                }
              } else {
                echo "Sorry, there was an error uploading your file. ERR: (" . ((string)$possibleError) . ")<br>";
              }
            }
          }
        ?>

      </p>
      <hr>
      <p>
        <h2> Works live on the SAA by  <?php echo "(".$user.")"; ?> </h2> <br>
        <table border="1">
          <tr><th>Image</th> <th>Title</th> <th>Tags</th> <th>Extra Data</th></tr>
            <?php
              $req = "SELECT * FROM liveArt WHERE artist = '$user'";
              $sql = mysqli_query($db, $req);
              while($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
                echo "<tr>";
                echo "<td> <center> <img src = '../uploads/" . $row['src'] . "' style ='height:500px; width:auto;'>" . "</center></td>";
                echo "<td><center>" . $row['title'] . "</center></td>";
                echo "<td><center>" . $row['tags'] . "</center></td>";
                echo "<td><center>" . $row['data'] . "</center></td>";
                echo "</tr>";
              }
            ?>
        </table>
        <h2> Works waiting to be approved and rated by  <?php echo "(".$user.")"; ?> </h2> <br>
        <table border="1">
          <tr><th>Image</th> <th>Title</th> <th>Tags</th> <th>Extra Data</th></tr>
            <?php
              $req = "SELECT * FROM pendingArt WHERE artist = '$user'";
              $sql = mysqli_query($db, $req);
              while($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
                echo "<tr>";
                echo "<td> <center> <img src = '../uploads/" . $row['src'] . "' style ='height:500px; width:auto;'>" . "</center></td>";
                echo "<td><center>" . $row['title'] . "</center></td>";
                echo "<td><center>" . $row['tags'] . "</center></td>";
                echo "<td><center>" . $row['data'] . "</center></td>";
                echo "</tr>";
              }
            ?>
        </table>
      </p>
    </center>
  </body>
</html>
