<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // Redirect user to welcome page
                            header("location: index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link rel="stylesheet" href = "login.css">
    <!--This allows the search icon to work-->
     <link rel="stylesheet" type = "text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- This allows the icons to work -->
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
</head>
<body>
  <div align= "left" style = "margin-left: 9em">
   <a href = "index.php"> <img src = "OBIGaming.png" height = "148px" width = "200px"  class = "img1" style = "margin-left: 8em; background:#E7E7E7; border:1px solid black" alt="OBI World Logo"></img></a>
   </br></br></br></br>
    <div><h1 style="margin-left:16em; margin-top:-14px">Cheapest Games on Demand </h1></div>
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
  </div>
</br>
  <div class = "loginbox">
    <img src = "avatar.jfif" alt = "avatar" class = "avatar"></img>
        <h2>Login Here</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <p>Username</p>
                <input type="text" name="username" placeholder="Enter Username"class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <p>Password</p>
                <input type="password" name="password" placeholder="Enter Password"class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <a href = "resetpass.php"> Forgot your password?</a>
            <br>
            <a href = "register.php"> Don't have an account?</a>
        </form>
    </div>
</body>
</html>
