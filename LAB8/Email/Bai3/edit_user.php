<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "Mail";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra xem có id không
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

// Nếu form được submit (ấn nút cập nhật)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hoten = $_POST['hoten'];
    $email = $_POST['email'];

    $sql = "UPDATE users SET hoten = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $hoten, $email, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Lỗi khi cập nhật: " . $conn->error;
    }
}

// Lấy dữ liệu người dùng cần sửa
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "Không tìm thấy người dùng!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa thông tin người dùng</title>
</head>
<body>
    <h2>Sửa thông tin người dùng</h2>
    <form method="POST">
        <label>Họ tên:</label><br>
        <input type="text" name="hoten" value="<?= htmlspecialchars($user['hoten']) ?>" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br><br>

        <button type="submit">Cập nhật</button>
        <a href="index.php">Hủy</a>
    </form>
</body>
</html>
