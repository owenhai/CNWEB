<?php
require "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST['category_id']);
    $name = trim($_POST['category_name']);

    if ($id && $name) {
        $stmt = $conn->prepare("UPDATE categories SET category_name=? WHERE category_id=?");
        $stmt->bind_param("si", $name, $id);
        $stmt->execute();
    }
}
header("Location: category_list.php");
