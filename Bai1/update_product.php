<?php
require "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST['product_id']);
    $cat_id = intval($_POST['category_id']);
    $name = trim($_POST['product_name']);
    $price = floatval($_POST['price']);

    if ($id && $name && $price > 0) {
        $stmt = $conn->prepare("UPDATE products SET category_id=?, product_name=?, price=? WHERE product_id=?");
        $stmt->bind_param("isdi", $cat_id, $name, $price, $id);
        $stmt->execute();
    }
}
header("Location: index.php");
