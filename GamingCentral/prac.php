<!-- LOGIN.php
<html>

<head>
<title> GamingCentral Login </title>
<link rel="stylesheet" href = "login.css">
<!--This allows the search icon to work-->
<link rel="stylesheet" type = "text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- This allows the icons to work -->
<script src='https://kit.fontawesome.com/a076d05399.js'></script>

</head>

  <body>
    <div align= "left" style = "margin-left: 9em">
     <a href = "home.php"> <img src = "OBIGaming.png" height = "148px" width = "200px"  class = "img1" style = "margin-left: 8em; background:#E7E7E7; border:1px solid black" alt="OBI World Logo"></img></a>
     </br></br></br></br>
      <div><h1 style="margin-left:16em; margin-top:-14px">Cheapest Games on Demand </h1></div>
    </div>
    <br><br>

    <!-- NavBar -->
    <div class="topnav">
    <a href = "index.php"class = "home" alt = "home"> <i class="fas fa-home"></i> Home</a>
    <a href = "xbox.php" class = "xbox" alt = "xbox"> <i class="fab fa-xbox"></i>box</a>
    <a href = "playstation.php" class = "playstation" alt = "playstation"> <i class="fab fa-playstation">laystation</i></a>
    <a href = "switch.php" class = "nintendo" alt = "nintendo"><i class="fas fa-gamepad"></i> Nintendo </a>
    <a href = "pc.php" class = "pc" alt = "PC"> PC <i class="fas fa-desktop"></i></a>
    <a href = "vr.php" class = "vr" alt = "VR"> VR <i class="fas fa-vr-cardboard"></i></a>
    <a href = "accessories.php" class = "accessories" alt = "Accessories"> Accessories <i class="fas fa-tshirt"></i></a>
    <a href = "login.php" class = "account" alt = "account">Account <i class="fas fa-user"></i></a>
    <a href = "cart.php" class = "shop" alt = "Shopping Cart"><i class="fas fa-shopping-cart"></i> Cart</a>

    <!-- Search bar and button -->
    <div class="search-container">
        <form action="search.php" method = "post">
          <input type = "text" id = "searchBox" name = "search" placeholder = "Search..." onfocus="this.placeholder=''" onblur = "this.placeholder='Search...'" class = "search">
          <button type="submit" name = "submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
    </div>
    </div>
    </br>

    <div class = "loginbox">
      <img src = "avatar.jfif" alt = "avatar" class = "avatar"></img>
      <h2>Login Here </h2>
      <form>
        <p>Username<p>
          <input type = "text" name = "" placeholder = "Enter Username">
          <p> Password </p>
          <input type = "password" name = "" placeholder="Enter Password">
          <input type = "submit" name = ""  value = "Login">
          <a href = "#"> Forgot your password?</a>
          <br>
          <a href = "register.php"> Don't have an account?</a>

    </div>

    </body>

    </html>

-->
ENDS HERE!







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
    <a href = "index.php"class = "home" alt = "home"> <i class="fas fa-home"></i> Home</a>
    <a href = "xbox.php" class = "xbox" alt = "xbox"> <i class="fab fa-xbox"></i>box</a>
    <a href = "playstation.php" class = "playstation" alt = "playstation"> <i class="fab fa-playstation">laystation</i></a>
    <a href = "nintendo.php" class = "nintendo" alt = "nintendo"><i class="fas fa-gamepad"></i> Nintendo </a>
    <a href = "pc.php" class = "pc" alt = "PC"> PC <i class="fas fa-desktop"></i></a>
    <a href = "vr.php" class = "vr" alt = "VR"> VR <i class="fas fa-vr-cardboard"></i></a>
    <a href = "accessories.php" class = "accessories" alt = "Accessories"> Accessories <i class="fas fa-tshirt"></i></a>
    <a href = "login.php" class = "account" alt = "account">Account <i class="fas fa-user"></i></a>
    <a href = "cart.php" class = "shop" alt = "Shopping Cart"><i class="fas fa-shopping-cart"></i> Cart</a>

  <!-- Search bar and button -->
  <div class="search-container">
      <form action="search.php" method = "post">
        <input type = "text" id = "searchBox" name = "search" placeholder = "Search..." onfocus="this.placeholder=''" onblur = "this.placeholder='Search...'" class = "search">
        <button type="submit" name = "submit"><i class="fa fa-search"></i></button>
      </form>

  </div>
  </div>
</body>
</html>

<?php
$connection = new PDO("mysql:host=localhost;dbname=search_bar",'root','');
if (isset($_POST["submit"])){
  $name = $_POST["search"];
  $db = $connection->prepare("SELECT * FROM `search` WHERE Name = '$name'");


  $db->setFetchMode(PDO:: FETCH_OBJ);
  $db -> execute();

if($row = $db->fetch())
{
  echo "<center></br></br>Results found for \"$name\"</center>";
  ?>
  <br>
<center>
  <table>

  <td><?php echo $row->Name; ?></td>
  <td><?php echo $row-> Description;?></td>
  <td><?php echo $row-> Image;?></td>
  <td><?php echo $row-> Price;?></td>
  <td><?php echo $row-> Amount;?></td>
  <td><?php echo $row-> Cart;?></td>
</tr>
  </table>
</center>
  <?php
}
else{

  echo "<center> </br> </br> 0 Results Found for \"$name\"</center>";
}

}
?>
