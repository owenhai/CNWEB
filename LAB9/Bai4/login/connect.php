<?php
$host = "localhost:3306";
$user = "root";
$pass = "";
$db   = "udn";

$con = mysqli_connect($host, $user, $pass, $db);

if (!$con) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

mysqli_set_charset($con, "utf8");
?>
