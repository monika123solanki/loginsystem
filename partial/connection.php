<?php
    $connection = mysqli_connect("localhost", "root", "", "users");
    if (!$connection) 
    {
        die("Error" . mysqli_error($connection));
    }
?>