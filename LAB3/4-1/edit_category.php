<?php
require "db.php";

if (!isset($_GET['category_id'])) {
    header("Location: category_list.php");
    exit;
}

$id = intval($_GET['category_id']);
$stmt = $conn->prepare("SELECT * FROM categories WHERE category_id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$cat = $result->fetch_assoc();

if (!$cat) {
    header("Location: category_list.php");
    exit;
}
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>Edit Category</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <h1>Edit Category</h1>
  <form method="post" action="update_category.php">
    <input type="hidden" name="category_id" value="<?= $cat['category_id'] ?>">
    <label>Name: <input type="text" name="category_name" value="<?= htmlspecialchars($cat['category_name']) ?>" required></label>
    <input type="submit" value="Update">
  </form>
  <p><a href="category_list.php">Back to Category List</a></p>
</div>
</body>
</html>
