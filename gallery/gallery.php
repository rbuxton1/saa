<?php
  include("../dash/config.php");
?>
​<html>
  <title>SAA</title>
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
          <button class="w3-btn w3-xlarge w3-dark-grey w3-hover-light-grey" onclick="location.href='dash/login.php'" style="font-weight:900;">LOGIN</button> <br> <br>
          <button class="w3-btn w3-xlarge w3-dark-grey w3-hover-light-grey" onclick="" style="font-weight:900;">GALLERY</button>
        </div>
      </div>
    </header>
    <hr><br>

    <!-- Body -->
    <div class="w3-center">
      <div class="w3-card-4">
        <div class="w3-container w3-green">
          <h2>Search SAA</h2>
        </div>
        <br>
        <form action="" method="post" class="w3-container">
          <div class="w3-container">
            <input class="w3-input" type="text" name="terms" placeholder="'Art', 'milk', 'ghost'" style="width:75%;display:inline;">
            <select class="w3-select" name="sortMode" style="width:20%;display:inline;">
              <option value="1">Sort By Author name</option>
              <option value="2">Sort By Newest</option>
              <option value="3">Sort By Oldest</option>
              <option value="4" disabled>Sort By Rating</option>
            </select>
          </div>
          <input type="submit" class="w3-btn w3-xlarge w3-dark-grey w3-hover-light-grey" value="Search" name="submit">
        </form>
    </div>

    <?php
      include("../dash/config.php");

      function generateCard($id, $src, $title, $artist, $data){
        echo "
        <div class='w3-card-4'>
          <div class='w3-container w3-dark-grey'>
            <h2>" . $title . "</h2>
          </div>
          <a href='view.php?id=" . $id . "'><img src='../uploads/" . $src . "' alt='missing image' style='width:50%'></a>
          <div class='w3-container w3-center'>
            <p>by: " . $artist . " <br> Description: " . $data . "</p>
          </div>
        </div>
        <br>
        ";
      }

      if(isset($_POST["terms"])) {
        echo "<p class='w3-large'> Searching '" . $_POST['terms'] . "'</p>";
        $terms = "%" . $_POST['terms'] . "%";
        $req = "SELECT * FROM liveArt WHERE artist LIKE '" . $terms . "' OR title LIKE '" . $terms . "' OR data LIKE '" . $terms . "'";
        $mode = $_POST["sortMode"];
        if($mode == 1){
          $req .= " ORDER BY artist";
        } elseif($mode == 2){
          $req .= " ORDER BY id DESC";
        } elseif($mode == 3){
          $req .= " ORDER BY id";
        } elseif($mode == 4){
          $req .= " ORDER BY rate DESC";
        }
        $sql = mysqli_query($db,$req);

        while($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
          generateCard($row['id'], $row['src'], $row['title'], $row['artist'], $row['data']);
        }
      }
    ?>

    <br>
    <!-- Footer -->
    <footer class="w3-container w3-theme-dark w3-padding-16">
      <p>
        <div class="w3-center">
          Student Art Archive <?php echo $version; ?> &emsp; <a href="https://github.com/rbuxton1/saa/wiki">Built and maintained by Ryan Buxton and Curtis Worthy</a> &emsp; Senior Project 2017-2018 OHS <br>
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
