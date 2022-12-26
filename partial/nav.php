<?php
  
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)    // if user is loggedin 
  {
    $loggedin = true;
  } 
  else                                                                  //if user is not loogedin
  {
    $loggedin = false;
  }

  echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <a class="navbar-brand" href="/loginsystem">INoM Technology</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">';

              if (!$loggedin)
              {
                  echo '<li class="nav-item">
                          <a class="nav-link" href="/loginsystem/index.php">Login</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="/loginsystem/signup.php">Sign Up</a>
                        </li>';
              }

              if ($loggedin)
              {
                  echo '<li class="nav-item">
                          <a class="nav-link" href="/loginsystem/product.php">Insert Product</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="/loginsystem/product_update.php">View Product</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="/loginsystem/logout.php">Logout</a>
                        </li>';
              }

      echo '</ul>
          </div>
        </nav>';
?>