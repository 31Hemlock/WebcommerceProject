<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Game Suite Catalog</title>
  <meta name="author" content="Ignacio Suarez-Marill">
  <meta name="keywords" content="game suite, games">
  <link href="css/bootstrap.min.css" rel="stylesheet" />
  <script src="jquery-3.1.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="format.css">
  <?php include 'navigationbar.html'; ?>
  <?php include 'consolenavigationbar.html'; ?>

  <body>
    <?php
      require_once("db.php");
      echo "<h1>New Arrivals</h1>";
      $sql = "select * from `games` where `releaseDate` > adddate(CURRENT_DATE, INTERVAL -14 DAY) and `releaseDate` < CURRENT_DATE";
      $result = $mydb->query($sql);
      echo "<div class='row'>";
      while($row = mysqli_fetch_array($result)){
        echo "<div class='col-xs-2 col-s-2 col-m-2'>"
          ."<img src='images&#92".$row["title"]."' class='img-rounded' width='150'<br />"
          ."<h3><a href='gameorder.php?gameID=".$row["gameID"]."'>".$row["title"]."</a></h3><br />"
          ."Retail Price: $".number_format($row["beforeRentPrice"], 2)."<br />"
          ."Rental Price: $".number_format($row["rentalRate"], 2)."<br />";
          if (empty($row["releaseDate"])){
            echo "Release Date: TBA<br />";
          }
          else{
            echo "Release Date: ".$row["releaseDate"]."<br />";
          }
          echo "</div>";
      }
      echo "</div>";

      echo "<h1>Coming Soon</h1>";
      $sql = "select * from `games` where `releaseDate` > CURRENT_DATE and `releaseDate` < adddate(CURRENT_DATE, INTERVAL 14 DAY)";
      $result = $mydb->query($sql);
      echo "<div class='row'>";
      while($row = mysqli_fetch_array($result)){
        echo "<div class='col-xs-2 col-s-2 col-m-2'>"
          ."<img src='images&#92".$row["title"]."' class='img-rounded' width='150'<br />"
          ."<h3><a href='gameorder.php?gameID=".$row["gameID"]."'>".$row["title"]."</a></h3><br />"
          ."Retail Price: $".number_format($row["beforeRentPrice"], 2)."<br />"
          ."Rental Price: $".number_format($row["rentalRate"], 2)."<br />";
          if (empty($row["releaseDate"])){
            echo "Release Date: TBA<br />";
          }
          else{
            echo "Release Date: ".$row["releaseDate"]."<br />";
          }
          echo "</div>";
      }
      echo "</div>";

      echo "<h3><a href='catalog'>See All Games</a></h3><br />";
    ?>
  </body>
</html>
