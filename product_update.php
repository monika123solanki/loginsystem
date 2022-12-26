<?php

    include 'partial/connection.php';


//========================== Delete Product ========================//

    if (isset($_REQUEST['delete'])) // if press delete button 
    {
        foreach ($_REQUEST['p_id'] as $id) //select multiple product id 
        {
            mysqli_query($connection, "DELETE FROM product WHERE id=$id");
        }
        echo "Data Deleted";
    }


//====================== View Product ============================//

    $result = mysqli_query($connection, "select * from product") or die("Table Not Found" . mysqli_error($connection));

    echo "<center><h3>View Product</h3><table cellspacing='15' border='10' cellpadding='30'style='border: 3px solid grey; border-collapse: collapse;' >";

    echo "<tr><th>Product ID</th><th>Product Name</th><th>Product M.R.P.</th><th>UPC</th><th>Product Status</th><th>Product Photo</th>
              <th> <input type='submit' value='Delete' name='delete' form='form1' class='btn btn-warning'> </th>
              <th> <input type='button' value='Edit' class='btn btn-primary'> </th>
          </tr>";

    while ($record = mysqli_fetch_array($result)) // Fetch data from database
    {
        echo "<tr>";
        echo "<td>" . $record['id'] . "</td>";
        echo "<td>" . $record['product_name'] . "</td>";
        echo "<td>" . $record['price'] . "</td>";
        echo "<td>" . $record['upc'] . "</td>";
        echo "<td>" . $record['status'] . "</td>";
        echo "<td><img src='" . $record['image'] . "'height='100'  width='100'></td>";
?>
    <form action="" id="form1" method="POST">
        <?php

            echo "<th> <input type='checkbox' name='p_id[]' value=" . $record['id'] . "></th>";
            echo "<td><a href='product.php?update=" . $record['id'] . "'>Edit</td></td>";
            echo "</tr>";
    }

        echo "</table></center>";?>

        <button style="margin: 20px 0 0 700px;"> <a href="product.php">Insert Product</a></button>
    </form>