<?php
  //$gameTitle = "";
  //if(isset($_GET["gameTitle"])) $gameTitle=$_GET["gameTitle"];
  //if(isset($_GET["platform"])) $gamePlatform=$_GET["platform"];
  $gameID = "";
  if(isset($_GET["gameID"])) $gameID=$_GET["gameID"];

  require_once("db.php");
  $sql = "select distinct title, releaseDate, esrbRating, genre, platform,
    publisher, developer, beforeRentPrice, afterRentPrice, rentalRate from games
    where gameID = '".$gameID."'";
  $result = $mydb->query($sql);
  $row = mysqli_fetch_array($result);
  echo "<div>"
    ."<img src='images&#92".$row["title"]."' class='img-rounded' width='200'<br />"
    ."<h3>".$row["title"]."</h3><br />"
    ."<strong>Retail Price:</strong> $".number_format($row["beforeRentPrice"], 2)." without rent<br />"
    ."<strong>Retail Price:</strong> $".number_format($row["afterRentPrice"], 2)." after rent<br />"
    ."<strong>Rental Price:</strong> $".number_format($row["rentalRate"], 2)."<br />";
  if (empty($row["esrbRating"])){
    echo "<strong>ESRB Rating:</strong> Product Not Rated Yet<br />";
  }
  else{
    echo "<strong>ESRB Rating:</strong> ".$row["esrbRating"]."<br />";
  }
  echo "<strong>Genre:</strong> ".$row["genre"]."<br />"
    ."<strong>Platform:</strong> ".$row["platform"]."<br />"
    ."<strong>Publisher:</strong> ".$row["publisher"]."<br />"
    ."<strong>Developer:</strong> ".$row["developer"]."<br />";
    if (empty($row["releaseDate"])){
      echo "<strong>Release Date:</strong> TBA<br />";
    }
    else{
      echo "<strong>Release Date:</strong> ".$row["releaseDate"]."<br />";
    }
    echo "</div>";
?>
