<?php
include("connect.php");

if (isset($_GET['user']) && isset($_GET['pass'])) {
    $user = trim($_GET['user']);
    $pass = trim($_GET['pass']);

    // Kiểm tra trong bảng giáo viên
    $sql1 = "SELECT * FROM giaovien WHERE magv='$user' AND matkhau='$pass'";
    $rs1 = mysqli_query($con, $sql1);

    // Kiểm tra trong bảng sinh viên
    $sql2 = "SELECT * FROM sinhvien WHERE masv='$user' AND matkhau='$pass'";
    $rs2 = mysqli_query($con, $sql2);

    if (mysqli_num_rows($rs1) > 0) {
        $row = mysqli_fetch_array($rs1);
        echo "<b>Xin chào Thầy/Cô: </b>" . $row['hoten'];
    } else if (mysqli_num_rows($rs2) > 0) {
        $row = mysqli_fetch_array($rs2);
        echo "<b>Xin chào Sinh viên: </b>" . $row['hoten'];
    } else {
        echo "<b style='color:red;'>Sai tên đăng nhập hoặc mật khẩu!</b>";
    }
}
?>
