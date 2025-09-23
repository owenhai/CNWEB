<?php
require "db.php";

if (isset($_POST['category_id'])) {
    $id = intval($_POST['category_id']);
    // kiểm tra có sản phẩm trong category không
    $check = $conn->prepare("SELECT COUNT(*) FROM products WHERE category_id=?");
    $check->bind_param("i", $id);
    $check->execute();
    $check->bind_result($count);
    $check->fetch();
    $check->close();

    if ($count == 0) {
        $stmt = $conn->prepare("DELETE FROM categories WHERE category_id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    } else {
        echo "<script>alert('Không thể xoá: vẫn còn sản phẩm trong category này'); window.location='category_list.php';</script>";
        exit;
    }
}
header("Location: category_list.php");
