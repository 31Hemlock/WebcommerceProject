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
      $category = "";
      if(isset($_GET["category"])){
        $category=$_GET["category"];
        $sql = "select * from games where platform = '".$category."' order by title, platform";
      }
      else $sql = "select * from games order by title, platform";
      $result = $mydb->query($sql);
      echo "<div class='row equal'>";
      while($row = mysqli_fetch_array($result)){
        echo "<div class='col-xs-6 col-s-3 col-m-2 col-lg-2'>"
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
    ?>
  </body>
</html>
