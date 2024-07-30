<?php
require_once "config.php";

$name = $password = $email = "";
$name_err = $password_err = $email_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

  // Check if username is empty
  if (empty(trim($_POST["email"]))) {
    $email_err = "Email cannot be blank";
  } else {
    $sql = "SELECT id FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
      mysqli_stmt_bind_param($stmt, "s", $param_email);

      // Set the value of param username
      $param_email = trim($_POST['email']);

      // Try to execute this statement
      if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) == 1) {
          $email_err = "User with the email already exists";
          echo "User with email already exists ";
          echo '<a href="login.php">Click here to log in</a>';
        } else {
          $email = trim($_POST['email']);
        }
      } else {
        echo "Something went wrong";
      }
    }
    mysqli_stmt_close($stmt);
  }



  // Check for password
  if (empty(trim($_POST['password']))) {
    $password_err = "Password cannot be blank";
  } elseif (strlen(trim($_POST['password'])) < 5) {
    $password_err = "Password cannot be less than 5 characters";
  } else {
    $password = trim($_POST['password']);
  }

  if (empty(trim($_POST['name']))) {
    $name_err = "Name cannot be blank";
  } else {
    $name = trim($_POST['name']);
  }



  // If there were no errors, go ahead and insert into the database
  if (empty($email_err) && empty($password_err) && empty($name_err)) {
    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
      mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_email, $param_password);

      // Set these parameters
      $param_name = $name;
      $param_email = $email;
      $param_password = password_hash($password, PASSWORD_DEFAULT);

      // Try to execute the query
      if (mysqli_stmt_execute($stmt)) {
        header("location: login.php");
      } else {
        echo "Something went wrong... cannot redirect!";
      }
    }
    mysqli_stmt_close($stmt);
  }
  mysqli_close($conn);
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

  <title>PetHouse - Register</title>
  <link rel="stylesheet" href="style.css">
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


  <div class="container" style="margin-top: 6rem;">
    <h3>Please Register Here:</h3>
    <hr>
    <form action="" method="post">
      <div class="form-row">
        <div class="form-group col-md-12">
          <label for="inputEmail4">Name</label>
          <input type="text" class="form-control" minlength="5" name="name" id="inputEmail4" placeholder="Name">
        </div>
        <div class="form-group col-md-12">
          <label for="inputEmail4">Email</label>
          <input type="email" class="form-control" name="email" id="inputEmail4" placeholder="Email">
        </div>
        <div class="form-group col-md-12">
          <label for="inputPassword4">Password</label>
          <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letterand one special character, and at least 8 or more characters" class="form-control" name="password" id="inputPassword4" placeholder=" Enter your Password">
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Sign up</button>
    </form>
    <h4 class="m-4">Already have an account <a href="login.php">click here to login</a>
    </h4>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>