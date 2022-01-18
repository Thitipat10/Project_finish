<?php
$connection = mysqli_connect("localhost", "root", "", "db_catalog");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL:" . mysqli_connect_errno();
    exit();
} else {
    //echo'success';
}
