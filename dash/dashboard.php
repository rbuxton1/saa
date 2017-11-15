<?php
  include('session.php');
  include('config.php');
  session_start();


  //basic data about guest
  $user = $_SESSION['login_user'];
?>
<html>
  <head>
    <title> SAA Dashboard </title>
  </head>
  <body>
    <center>
      <h1> Welcome, <?php echo $user; ?> ! </h1>
      <p>
        Click <a href="logout.php">here</a> to log out. <br>
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

          $name = $_SESSION['login_user'];
          $title = $_POST['title'];

          $target_dir = "uploads/";
          $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
          $uploadOk = 1;
          $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
          // Check if image file is a actual image or fake image
          if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
              echo "File is an image - " . $check["mime"] . ".";
              $uploadOk = 1;

              $sql = "INSERT INTO pendingArt (id, title, src, tags, rate, artist, data) VALUES (NULL, '$title', '$target_file', 'NO_TAG', NULL, '$name', NULL)";

            } else {
              echo "File is not an image.";
              $uploadOk = 0;
            }
          }
        ?>

      </p>
      <hr>
      <p>
        Uploaded works by this artist here
      </p>
    </center>
  </body>
</html>
