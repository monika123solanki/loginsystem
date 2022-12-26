<?php
  $showAlert = false;
  $showError = false;
  if (!empty($_POST))                        // When press the Submit button 
   {
    include 'partial/connection.php';
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $exists = false;
   
    if (($password == $cpassword) && $exists == false)                
      {
        $sql = "INSERT INTO register (`email`, `password`) VALUES ('$email', '$password')";
        $result = mysqli_query($connection, $sql);
        if ($result) 
          {
            $showAlert = true;
          }
      } 
    else
      {
        $showError = "Password do not match";
      }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
  <title>Sign Up</title>
</head>

<body>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>

  <?php require 'partial/nav.php' ?>
  
  <?php
    if ($showAlert) 
    {
      header("location:product.php");
    }
    if ($showError) 
    {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> ' . $showError . '
            </div>';
    }
  ?>

  <div class="container my-4">
    <h1 class="text-center">Sign Up to our website</h1>
<!--	Form Start for User Data email and password -->
    <form action="/loginsystem/signup.php" method="post">
    <!-- Fill Email for user -->
      <div class="form-group">
        <label for="email">Email </label>
        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
      </div>
    <!-- Fill Password for user -->
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>

    <!-- Fill Confirm Password for user -->  
      <div class="form-group">
        <label for="cpassword">Confirm Password</label>
        <input type="password" class="form-control" id="cpassword" name="cpassword">
        <small id="email" class="form-text text-muted">Make sure to type the same password.</small>
      </div>
      
      <button type="submit" class="btn btn-primary">SignUp</button>
      Already have an account? &nbsp;<a href="index.php" class="float-end">Please Sign In</a>

    </form>
<!-- Form End -->
  </div>
</body>
</html>