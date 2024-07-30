<?php
//This script will handle login

session_start();
// check if the user is already logged in
if (isset($_SESSION['name'])) {

  header("location: register.php");
  exit;
}
require_once "config.php";

$email = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  if (empty(trim($_POST["email"])) || empty(trim($_POST['password']))) {
    $err = "Please enter email + password";
  } else {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
  }


  if (empty($err)) {
    $sql = "SELECT * FROM users WHERE email= '$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count == 1) {
      echo "<h1>Logged in Successfully</h1>";
      session_start();
      $_SESSION["id"] = $row['id'];
      $_SESSION["email"] = $row['email'];
      $_SESSION["name"] = $row['name'];

      $_SESSION["loggedin"] = true;
      header('location:index.php');
    }

    // $stmt = mysqli_prepare($conn, $sql);
    // $param_email = $email;
    // mysqli_stmt_bind_param($stmt, "s", $param_email);


    // if(mysqli_stmt_execute($stmt)){
    //     mysqli_stmt_store_result($stmt);

    //     if(mysqli_stmt_num_rows($stmt) == 1)
    //             {
    //                 mysqli_stmt_bind_result($stmt, $id, $name, $hashed_password,$email);

    //                 if(mysqli_stmt_fetch($stmt))
    //                 {
    //                     if(password_verify($password, $hashed_password))
    //                     {
    //                         // this means the password is corrct. Allow user to login
    //                         session_start();
    //                         $_SESSION["name"] = $name;
    //                         $_SESSION["id"] = $id;
    //                         $_SESSION["loggedin"] = true;
    //                         echo "Welcome";
    //                         //Redirect user to welcome page
    //                         header("location: index.php");


    //                     }
    //                 }

    //             }

    // }
  }
}


?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css" />
  <title>PetHouse - Login</title>
</head>

<body>

  <div class="nav">
    <div class="nav_img">
      <img src="images/Logo-removedBG.png" alt="" />
    </div>
    <div class="nav_content">
      <a href="index.php">Home</a>
      <a href="shop.php">Shop</a>
      <a href="service.php">Services</a>
      <a href="about.php">About Us</a>
    </div>
    <div class="nav_buttons">
      <a href="login.php">LOG IN</a>
    </div>
  </div>

  <div class="container " style="margin-top: 6rem;">
    <h3>Please Login Here:</h3>
    <hr>

    <form action="" method="post">
      <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Email">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter and one special character, and at least 8 or more characters" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Password">
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <h4 class="m-4">Dont have an account! <a href="register.php">Click here to register</a> </h4>



  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>