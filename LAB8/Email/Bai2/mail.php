<?php
// Nhúng các thư viện PHPMailer cần thiết
require "PHPMailer-master/src/PHPMailer.php";
require "PHPMailer-master/src/SMTP.php";
require 'PHPMailer-master/src/Exception.php';

// Sử dụng namespace của PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Kiểm tra xem form đã được gửi đi bằng phương thức POST chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer(true); // true: bật chế độ Exception

    try {
        // --- CẤU HÌNH SERVER ---
        // Bật chế độ debug (hiển thị chi tiết lỗi)
        // 0 = tắt debug
        // 1 = hiển thị thông báo từ client
        // 2 = hiển thị thông báo từ client và server (khuyên dùng để gỡ lỗi)
        $mail->SMTPDebug = 2;

        $mail->isSMTP(); // Sử dụng SMTP
        $mail->CharSet = "utf-8"; // Hỗ trợ tiếng Việt
        $mail->Host = 'smtp.gmail.com'; // Server SMTP của Gmail
        $mail->SMTPAuth = true; // Bật xác thực SMTP

        // --- THÔNG TIN ĐĂNG NHẬP ---
        // Thay bằng email và mật khẩu ứng dụng của bạn
        $nguoigui = 'cuongnq.24itb@vku.udn.vn';
        $matkhau = 'ussnlzquuaykwunt'; // ĐÂY PHẢI LÀ MẬT KHẨU ỨNG DỤNG
        $tennguoigui = 'Sư phụ';

        $mail->Username = $nguoigui; // Tên đăng nhập SMTP
        $mail->Password = $matkhau; // Mật khẩu SMTP
        $mail->SMTPSecure = 'ssl'; // Giao thức bảo mật: ssl hoặc tls
        $mail->Port = 465; // Cổng kết nối: 465 cho ssl, 587 cho tls

        // --- THÔNG TIN NGƯỜI GỬI, NGƯỜI NHẬN ---
        $mail->setFrom($nguoigui, $tennguoigui); // Email và tên người gửi

        $to = $_POST['email']; // Lấy email người nhận từ form
        $to_name = "bạn"; // Tên người nhận (có thể tùy chỉnh)
        $mail->addAddress($to, $to_name); // Thêm người nhận

        // Thêm địa chỉ nhận khác nếu cần (ví dụ: gửi cho chính bạn)
        $mail->addAddress("nguyenquoccuong1803@gmail.com","cuong");

        // --- NỘI DUNG EMAIL ---
        $mail->isHTML(true); // Định dạng email là HTML
        $mail->Subject = $_POST['tieude']; // Lấy tiêu đề từ form

        // Tạo nội dung email
        $noidungthu = ' <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title"><b>Xin chào ' . $to_name . '</b></h5>
                                <p class="card-text">' . $_POST['content'] . '</p>
                            </div>
                        </div> ';
        $mail->Body = $noidungthu;

        // --- ĐÍNH KÈM TỆP TIN ---
        // Kiểm tra xem có tệp được tải lên và không bị lỗi không
        if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
            $mail->addAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);
        }

        /*
        * Cấu hình này dùng để bỏ qua việc xác minh chứng chỉ SSL.
        * Nó hữu ích khi chạy trên localhost (XAMPP) nhưng không an toàn cho môi trường production.
        * Hãy giữ lại nếu bạn đang gặp lỗi liên quan đến SSL.
        */
        $mail->smtpConnect(array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
                "allow_self_signed" => true
            )
        ));

        // Gửi email
        if ($mail->send()) {
            echo "Gửi email thành công!";
            // header("Location:index.php"); // Bỏ comment dòng này sau khi đã gỡ lỗi xong
        } else {
            echo "Gửi email thất bại!";
        }

    } catch (Exception $e) {
        echo 'Mail không gửi được. Lỗi chi tiết: ', $mail->ErrorInfo;
    }
}
?>
