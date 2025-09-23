<?php
require "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $category_id = intval($_POST['category_id']);
    $product_name = trim($_POST['product_name']);
    $price = floatval($_POST['price']);

    if ($product_name && $price > 0) {
        $stmt = $conn->prepare("INSERT INTO products (category_id, product_name, price) VALUES (?,?,?)");
        $stmt->bind_param("isd", $category_id, $product_name, $price);
        $stmt->execute();
    }
}
header("Location: index.php");
