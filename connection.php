<?php  
$conn = mysqli_connect("localhost", "root", "", "db_test");

if (!$conn) {
 echo "Error: Unable to connect to MySQL.";
}
