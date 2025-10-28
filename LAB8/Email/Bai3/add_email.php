<?php
$conn = new mysqli("localhost:3306", "root", "", "Mail");
if ($conn->connect_error) die("Kết nối thất bại: " . $conn->connect_error);

if (!empty($_POST['hoten']) && !empty($_POST['email'])) {
    $hoten = $conn->real_escape_string($_POST['hoten']);
    $email = $conn->real_escape_string($_POST['email']);
    $sql = "INSERT IGNORE INTO users(hoten, email) VALUES ('$hoten', '$email')";
    if ($conn->query($sql) === TRUE) {
        echo "✅ Đã thêm người nhận thành công!<br><a href='index.php'>Quay lại</a>";
    } else {
        echo "❌ Lỗi khi thêm: " . $conn->error;
    }
}
$conn->close();
?>
