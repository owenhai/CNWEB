<?php
require "db.php";

if (isset($_POST['product_id'])) {
    $id = intval($_POST['product_id']);
    $stmt = $conn->prepare("DELETE FROM products WHERE product_id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
header("Location: index.php");
