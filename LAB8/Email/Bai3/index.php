<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Gửi Email Cho Nhiều Người</title>
    <style>
        body { font-family: Arial; margin: 40px; background: #f4f4f4; }
        .container { background: #fff; padding: 25px; border-radius: 10px; width: 650px; margin: auto; box-shadow: 0 0 10px #ccc; }
        input, textarea { width: 100%; margin-bottom: 10px; padding: 8px; }
        button { padding: 10px 20px; cursor: pointer; background: #007bff; border: none; color: white; border-radius: 5px; }
        h2 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>
<div class="container">
    <h2>Thêm Người Nhận Vào Danh Sách</h2>
    <form action="add_email.php" method="POST">
        <input type="text" name="hoten" placeholder="Họ tên" required>
        <input type="email" name="email" placeholder="Địa chỉ email" required>
        <button type="submit">Thêm Người Nhận</button>
    </form>

    <hr>

    <h2>Gửi Email Cho Tất Cả Người Trong Danh Sách</h2>
    <form action="send_mail.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="tieude" placeholder="Tiêu đề email" required>
        <textarea name="content" rows="6" placeholder="Nội dung email..." required></textarea>
        <input type="file" name="file">
        <button type="submit">Gửi Email</button>
    </form>

    <hr>

    <h3>Danh sách email hiện có</h3>

<?php
// Kết nối CSDL
$servername = "localhost";
$username = "root";  // hoặc tên user MySQL của anh
$password = "";      // nếu có mật khẩu thì điền vào đây
$dbname = "Mail";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Truy vấn dữ liệu
$sql = "SELECT * FROM users ORDER BY id DESC";
$result = $conn->query($sql);
?>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Họ tên</th>
        <th>Email</th>
        <th>Ngày tạo</th>
        <th>Hành động</th>
    </tr>

    <?php
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['hoten']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['ngay_tao']."</td>";
            echo "<td>
                    <a href='edit_user.php?id=".$row['id']."'>Sửa</a> |
                    <a href='delete_user.php?id=".$row['id']."' onclick=\"return confirm('Xoá người này?');\">Xoá</a>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>Chưa có email nào trong danh sách</td></tr>";
    }

    $conn->close();
    ?>
</table>


</div>
</body>
</html>
