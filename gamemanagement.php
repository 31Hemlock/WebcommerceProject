<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Game Suite Manage Games</title>
    <meta name="author" content="Ignacio Suarez-Marill">
    <meta name="keywords" content="game suite, games">
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <script src="jquery-3.1.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="format.css">
    <?php include 'navigationbar.html'; ?>
    <script>

      //JQUERY CODE
      $(function(){
        $("#submit").click(function(){
          alert("Yep, it works.");

          if ($("#gameSelection").val() == 0){
            alert("Please select a game to submit changes");
          }
          else {
            var gameID = $("#gameSelection").val();
            var newBRPrice = $("#beforeRentPrice").val();
            var newARPrice = $("#afterRentPrice").val();
            var newRentalRate = $("#rentalRate").val();
            var newQuantity = $("#quantity").val();
            alert(newQuantity);
            $.ajax({
              url: 'updateGames.php',
              data: {'gameID': gameID,
              'brPrice': newBRPrice,
              'arPrice': newARPrice,
              'rentalRate': newRentalRate,
              'quantity': newQuantity
              },
            success: function(result) {
                alert("Games Database Changed");
                $("#sqlstatement").html(result);
            }
          });
          }
        })
        $("#gameSelection").change(function(){
          if(this.value != 0) {
            var gameID = this.value;
            $.ajax({
              url:"gamedetails.php",
              data: {'gameID': gameID},
              async:true,
              success: function(result){
                $("#contentArea").html(result);
              }
            })
          }
          else{
            $("#contentArea").html("");
          }
        });
      })
    </script>
  </head>
  <body>
    <p>
      <h3>Choose a Game To View:</h3>
      <select name="gameSelection" id="gameSelection">
        <option value="0">Select Game</option>
          <?php
            require_once("db.php");
            $sql = "select * from games order by title, platform";
            $result = $mydb->query($sql);
            while($row = mysqli_fetch_array($result)){
              echo "<option value='".$row["gameID"]."'>".$row["title"]." (".$row["platform"].")</option>";
            }
          ?>
      </select>
      </br>
    </p>
    <div id="contentArea">&nbsp;</div>
    <div id="sqlstatement">&nbsp;</div>
    <p id="changeInfo">
      <h3>Change Game Pricing and Quantity:</h3>
      <label>Before Rent Price:
        <input id="beforeRentPrice" type="numeric" placeholder="59.99" min="0" step="0.01" />
      </label></br>
      <label>After Rent Price:
        <input id="afterRentPrice" type="numeric" placeholder="53.99" min="0" step="0.01" />
      </label></br>
      <label>Rental Rate:
        <input id="rentalRate" type="numeric" placeholder="6.99" min="0" step="0.01" />
      </label></br>
      <label>Quantity:
        <input id="quantity" type="numeric" value="0" min="0"/>
      </label></br>
      <button id="submit">Submit Change</button>
    </p>
  </body>
</html>
