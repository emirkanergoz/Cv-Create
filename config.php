<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "cv_project";
$conn = mysqli_connect($host, $user, $pass,$db);

if (!$conn) {
    die("Network Error: " . mysqli_connect_error());
}
?>