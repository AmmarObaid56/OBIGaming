<html>

<head>
  <!-- Connects to css -->
  <link rel="stylesheet" href="index.css">
  <!--This allows the search icon to work-->
  <link rel="stylesheet" type = "text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


  <!--This allows the icons to work -->
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>


</head>

  <body style = "background:url(backgroundimg.jpg);  margin = 0; padding = 0; background-size:cover; background-position: center; font-family: sans-serif;">

      <div align= "left" style = "margin-left: 9em">
       <a href = "index.php"> <img src = "OBIGaming.png" height = "148px" width = "200px"  class = "img1" style = "margin-left: 8em; background:#E7E7E7; border:1px solid black" alt="OBI World Logo"></img></a>
       <br></br><br></br>
        <h1 style="margin-left:16em; margin-top:-14px">Cheapest Games on Demand </h1>
      </div>
      <br><br>

  <!-- NavBar -->
  <div class="topnav">
    <a href = "index.html"class = "home" alt = "home"> <i class="fas fa-home"></i> Home</a>
    <a href = "xbox.html" class = "xbox" alt = "xbox"> <i class="fab fa-xbox"></i>box</a>
    <a href = "playstation.html" class = "playstation" alt = "playstation"> <i class="fab fa-playstation">laystation</i></a>
    <a href = "nintendo.html" class = "nintendo" alt = "nintendo"><i class="fas fa-gamepad"></i> Nintendo </a>
    <a href = "pc.html" class = "pc" alt = "PC"> PC <i class="fas fa-desktop"></i></a>
    <a href = "vr.html" class = "vr" alt = "VR"> VR <i class="fas fa-vr-cardboard"></i></a>
    <a href = "accessories.html" class = "accessories" alt = "Accessories"> Accessories <i class="fas fa-tshirt"></i></a>
    <a href = "login.php" class = "account" alt = "account">Account <i class="fas fa-user"></i></a>
    <a href = "carts.php" class = "shop" alt = "Shopping Cart"><i class="fas fa-shopping-cart"></i> Cart</a>

  <!-- Search bar and button -->
  <div class="search-container">
      <form action="searchs.php" method = "post">
        <input type = "text" id = "searchBox" name = "search" placeholder = "Search..." onfocus="this.placeholder=''" onblur = "this.placeholder='Search...'" class = "search">
        <button type="submit" name = "submit"><i class="fa fa-search"></i></button>
      </form>

  </div>
  </div>
  <script>
  /* When the user clicks on the button,
  toggle between hiding and showing the dropdown content */
  function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
  }

  // Close the dropdown if the user clicks outside of it
  window.onclick = function(e) {
    if (!e.target.matches('.dropbtn')) {
    var myDropdown = document.getElementById("myDropdown");
      if (myDropdown.classList.contains('show')) {
        myDropdown.classList.remove('show');
      }
    }
  }
  </script>
</body>
</html>

<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "search_bar";

$conn = mysqli_connect($server, $username, $password, $dbname);

$sql = "SELECT * FROM search";
$result = mysqli_query($conn,$sql);
$queryResults = mysqli_num_rows($result);


if(isset($_POST['submit'])){
  $search = mysqli_real_escape_string($conn, $_POST['search']);
  $sql = "SELECT * FROM search WHERE Name LIKE '%$search%' OR Description LIKE '%$search%'OR Image LIKE '%$search%'
  OR Price LIKE '%$search%' OR Amount LIKE '%$search%' OR Cart LIKE '%$search%'";
  $result = mysqli_query($conn, $sql);
  $queryResults = mysqli_num_rows($result);

echo  "<center> </br> </br> $queryResults Results Found for \"$search\"</center>";
  if ($queryResults > 0) {
    while ($row = mysqli_fetch_assoc($result)){

      echo "</br></br> <center><table> <div class = 'game-box'> <td>".$row['Name'] ."</td>
      <td>".$row['Description'] ."</td>
      <td>".$row['Image'] ."</td>
      <td>".$row['Price'] ."</td>
      <td>".$row['Amount'] ."</td>
      <td>".$row['Cart'] ."</td>
       </div></table> </center>";
    }
  }else {

  }

}
 ?>
