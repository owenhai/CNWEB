<?php
require "db.php";

if (!isset($_GET['product_id'])) {
    header("Location: index.php");
    exit;
}

$id = intval($_GET['product_id']);
$stmt = $conn->prepare("SELECT * FROM products WHERE product_id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    header("Location: index.php");
    exit;
}

// lấy category cho dropdown
$cats = $conn->query("SELECT * FROM categories ORDER BY category_name ASC");
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>Edit Product</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <h1>Edit Product</h1>
  <form method="post" action="update_product.php">
    <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
    <label>Category:
      <select name="category_id">
        <?php while($c = $cats->fetch_assoc()): ?>
          <option value="<?= $c['category_id'] ?>" <?= ($c['category_id']==$product['category_id']?'selected':'') ?>>
            <?= htmlspecialchars($c['category_name']) ?>
          </option>
        <?php endwhile; ?>
      </select>
    </label>
    <label>Name: <input type="text" name="product_name" value="<?= htmlspecialchars($product['product_name']) ?>" required></label>
    <label>Price: <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" required></label>
    <input type="submit" value="Update">
  </form>
  <p><a href="index.php">Back to Product List</a></p>
</div>
</body>
</html>
