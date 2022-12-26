<?php
  $login = false;
  $showError = false;
  $showAlert = false;
  if (!empty($_POST))                        // When press the Submit button 
  {
    include 'partial/connection.php';
    $email = $_POST["email"];
    $password = $_POST["password"];
    $sql = "SELECT * from register where email='$email' AND password='$password'";
    $result = mysqli_query($connection, $sql);
    $num = mysqli_num_rows($result);

    if ($num == 1)                           //select number of row from database table
    {
      $login = true;
      session_start();
      $_SESSION['loggedin'] = true;
      $_SESSION['email'] = $email;
      header("location:product.php");
    } 
    else 
    {
      $showError = "Invalid Credentials";
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
  <title>Login</title>
</head>

<body>
  <!--  Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>

  <?php require 'partial/nav.php' ?>
  <?php
    if ($showError) 
    {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> ' . $showError . '
            </div>';
    }
  ?>

  <div class="container my-4">
    <h1 class="text-center">Login to our website</h1>
<!--	Form Start for User Data email and password -->
    <form action="/loginsystem/index.php" method="post">
  <!-- Fill Email for user -->
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" name="email" id="email" aria-describedby="emailHelp">
      </div>
      
  <!-- Fill Password for user -->
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>

      <button type="submit" class="btn btn-primary">Login</button>
      Don't have an acoount? &nbsp;<a href="signup.php" class="float-end">Create One</a>
    </form>
<!-- Form End -->
  </div>
</body>
</html>