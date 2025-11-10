<?php
$host = "localhost:3306";
$user = "root";      // tên tài khoản MySQL của anh
$pass = "";          // mật khẩu MySQL (để trống nếu mặc định XAMPP)
$db   = "udn";       // database udn (đã import file udn.sql)

$con = mysqli_connect($host, $user, $pass, $db);
if (!$con) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}
mysqli_set_charset($con, "utf8");
?>
