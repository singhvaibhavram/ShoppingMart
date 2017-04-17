<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e-cart";

// Create connection
$conn = mysqli_connect('localhost', 'root', '','onlineshopping');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
