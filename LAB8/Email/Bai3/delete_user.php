<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "Mail";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Lỗi khi xoá: " . $conn->error;
    }
} else {
    header("Location: index.php");
    exit;
}
?>
