<?php
require "db.php";

// Lấy danh sách product + category
$sql = "SELECT p.product_id, p.product_name, p.price, c.category_name, c.category_id
        FROM products p
        JOIN categories c ON p.category_id = c.category_id
        ORDER BY p.product_id ASC";
$products = $conn->query($sql);

// Lấy category cho dropdown thêm sản phẩm
$cats = $conn->query("SELECT * FROM categories ORDER BY category_name ASC");
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>Product List</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <h1>Product Music</h1>
  <h2 style="color:orange">Product List</h2>

  <table border="1" cellpadding="6" cellspacing="0">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Category</th>
      <th>Price</th>
      <th>Actions</th>
    </tr>
    <?php while($row = $products->fetch_assoc()): ?>
      <tr>
        <td><?= $row['product_id'] ?></td>
        <td><?= htmlspecialchars($row['product_name']) ?></td>
        <td><?= htmlspecialchars($row['category_name']) ?></td>
        <td><?= number_format($row['price'], 2) ?></td>
        <td>
          <!-- Edit -->
          <form method="get" action="edit_product.php" style="display:inline">
            <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
            <input type="submit" value="Edit">
          </form>
          <!-- Delete -->
          <form method="post" action="delete_product.php" style="display:inline">
            <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
            <input type="submit" value="Delete">
          </form>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>

  <h3 style="color:orange">Add Product</h3>
  <form method="post" action="add_product.php">
    <label>Category:
      <select name="category_id" required>
        <?php while($c = $cats->fetch_assoc()): ?>
          <option value="<?= $c['category_id'] ?>"><?= htmlspecialchars($c['category_name']) ?></option>
        <?php endwhile; ?>
      </select>
    </label>
    <label>Name: <input type="text" name="product_name" required></label>
    <label>Price: <input type="number" step="0.01" name="price" required></label>
    <input type="submit" value="Add">
  </form>

  <p><a href="category_list.php">List Categories</a></p>
</div>
</body>
</html>
