<?php
$host = "localhost:3306";
$user = "root";
$pass = "";
$dbname = "music_store";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
$conn->set_charset("utf8");
