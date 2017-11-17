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

          $target_dir = str_replace("www/","",getcwd());;
          $source = basename($_FILES["fileToUpload"]["name"]);
          $target_file = $target_dir . $source;
          $uploadOk = 1;
          $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

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
        Uploaded works by this artist here
      </p>
    </center>
  </body>
</html>
