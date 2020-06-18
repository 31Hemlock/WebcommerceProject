<?php
  $gameID = "";
  $brPrice = "";
  $arPrice = "";
  $rentalRate = "";
  $quantity = "";

  if(isset($_GET["gameID"])){
    $gameID=$_GET["gameID"];
    $sql = "update games set";
    if(isset($_GET["brPrice"]) || isset($_GET["arPrice"]) ||
      isset($_GET["rentalRate"]) || isset($_GET["quantity"])){
      if(is_numeric($_GET["brPrice"])){
        $brPrice=$_GET["brPrice"];
        $sql.= " brPrice = ".$brPrice.",";
      }
      if(is_numeric($_GET["arPrice"])){
        $arPrice=$_GET["arPrice"];
        $sql.= " arPrice = ".$arPrice.",";
      }
      if(is_numeric($_GET["rentalRate"])){
        $rentalRate=$_GET["rentalRate"];
        $sql.= " rentalRate = ".$rentalRate.",";
      }
      if(is_numeric($_GET["quantity"])){
        $quantity=$_GET["quantity"];
        $sql.= " quantity = ".$quantity.",";
      }
      $sql = substr($sql, 0, -1);
    }
    $sql.= " where gameID = ".$gameID;
  }
  echo($sql);
  require_once("db.php");

  $result = $mydb->query($sql);

?>
