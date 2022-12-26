<?php
  include 'partial/connection.php';

  session_start();
  if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) 
  {
    header("location:index.php");
    exit;
  }

//=================== Update ===================
  if (isset($_REQUEST['update'])) 
  {
    $edit = $_REQUEST['update'];
    //echo $edit;
    $result = mysqli_query($connection, "select * from product where id='" . $edit . "'") or die('select Error!!' . mysqli_error($connection));
    $record = mysqli_fetch_array($result);
  }
  if (@$_POST['btn'] == 'Update')
   {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $upc = $_POST['upc'];
    $status = $_POST['status'];
    $mid = @$_POST['p_id'];

    $image = @$_POST['oimg'];

    if ($_FILES['pic']['name'] != "") 
    {
      $image = "image/" . rand(1, 1000) . $_FILES['pic']['name'];
      move_uploaded_file($_FILES['pic']['tmp_name'], $image);
      unlink($_REQUEST['oimg']);
    }
    mysqli_query($connection, "update product set product_name='$product_name', price='$price', upc='$upc', status='$status', image='$image' where id='" . $mid . "' ") or die('update Error!!' . mysqli_error($connection));
    echo "<script>alert('Data Updates')</script>";
    echo "<script>window.location.replace('product_update.php')</script>";
  }

//=================== Insert ====================
  if (@$_POST['btn'] == 'Insert') 
  {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $upc = $_POST['upc'];
    $status = $_POST['status'];
    $image = "image/" . rand(1, 1000) . $_FILES['pic']['name'];
    move_uploaded_file($_FILES['pic']['tmp_name'], $image);
    mysqli_query($connection, "INSERT INTO `product` (`product_name`, `price`,`upc`, `status`, `image`,`created_at`) VALUES ('$product_name', '$price','$upc', '$status','$image', current_timestamp())");
    echo "<script>alert('Data Inserted')</script>";
    echo "<script>window.location.replace()</script>";
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
  <title>Welcome To INoM Technology</title>
</head>
<body>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
  <?php require 'partial/nav.php'; ?>
  <div class="container my-4">

<!--	Form Start product details -->
    <form action="product.php" method="post" enctype="multipart/form-data">

      <h1>Product Details</h1>

      <input type="hidden" name="p_id" value="<?php echo @$record['id']; ?>" />

      <input type="hidden" name="oimg" value="<?php echo @$record['image']; ?>" />

      <div class="form-group">
        <label for="product_name">Product Name</label>
        <input type="text" class="form-control" name="product_name" id="product_name" value="<?php echo @$record['product_name']; ?>" />
      </div>

      <div class="form-group">
        <label for="price">Price</label>
        <input type="text" class="form-control" id="price" name="price" value="<?php echo @$record['price']; ?>" />
      </div>

      <div class="form-group">
        <label for="upc">UPC</label>
        <input type="text" class="form-control" id="upc" name="upc" value="<?php echo @$record['upc']; ?>" />
      </div>

      <div class="form-group">
        Status<label for="instock">
          <input type="radio" name="status" id="instock" value="instock" <?php if (@$record['status'] == 'instock') echo 'checked'; ?> />Instock
        </label>

        <label for="outstock">
          <input type="radio" name="status" id="outstock" value="outofstock" <?php if (@$record['status'] == 'outofstock') echo 'checked'; ?> />Out of stock
        </label>
      </div>

      <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="pic" />
      </div>
      <input type="submit" name='btn' value="<?php if (isset($_REQUEST['update'])) echo 'Update'; else echo 'Insert'; ?>"/>
     
    </form>
<!-- Form End -->
  </div>
</body>
</html>