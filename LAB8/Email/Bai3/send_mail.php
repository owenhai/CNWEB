<?php
require "PHPMailer-master/src/PHPMailer.php";
require "PHPMailer-master/src/SMTP.php";
require "PHPMailer-master/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Kết nối đến database Mail
$conn = new mysqli("localhost:3306", "root", "", "Mail");
if ($conn->connect_error) die("Kết nối thất bại: " . $conn->connect_error);

// Lấy danh sách email + họ tên
$users = [];
$result = $conn->query("SELECT hoten, email FROM users");
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}
$conn->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->CharSet = "utf-8";
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'cuongnq.24itb@vku.udn.vn'; // mail của anh
        $mail->Password = 'ussnlzquuaykwunt'; // mật khẩu ứng dụng
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('cuongnq.24itb@vku.udn.vn', 'Sư phụ');
        $mail->isHTML(true);
        $mail->Subject = $_POST['tieude'];
        $mail->Body = nl2br($_POST['content']);

        // Thêm tệp đính kèm nếu có
        if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
            $mail->addAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);
        }

        // Gửi cho từng người trong danh sách
        foreach ($users as $user) {
            $mail->addAddress($user['email'], $user['hoten']);
        }

        $mail->smtpConnect(array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
                "allow_self_signed" => true
            )
        ));

        if ($mail->send()) {
            echo "✅ Đã gửi email cho " . count($users) . " người thành công!";
        } else {
            echo "❌ Gửi thất bại!";
        }

    } catch (Exception $e) {
        echo "Lỗi: " . $mail->ErrorInfo;
    }
}
?>
