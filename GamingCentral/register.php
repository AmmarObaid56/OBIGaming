<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
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
    <title> GamingCentral Login </title>
    <link rel="stylesheet" href = "register.css">
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
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">

</head>
<body>
  <center>
    <div class= "registerbox">
      <img src = "avatar.jfif" alt = "avatar" class = "avatar"></img>
        <h2>Sign Up</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" placeholder="Enter Username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter Password"class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" placeholder="Confirm Password"class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
           <a href="login.php">Already have an account?</a>
        </form>
    </div>
  </center>
</body>
</html>
