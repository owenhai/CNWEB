<?php
require "db.php";

// Lấy danh sách category
$result = $conn->query("SELECT * FROM categories ORDER BY category_id ASC");
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>Category List</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <h1>Product Manager</h1>
  <h2 style="color:orange">Category List</h2>

  <table border="1" cellpadding="6" cellspacing="0">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Actions</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['category_id'] ?></td>
        <td><?= htmlspecialchars($row['category_name']) ?></td>
        <td>
          <!-- Edit -->
          <form method="get" action="edit_category.php" style="display:inline">
            <input type="hidden" name="category_id" value="<?= $row['category_id'] ?>">
            <input type="submit" value="Edit">
          </form>
          <!-- Delete -->
          <form method="post" action="delete_category.php" style="display:inline">
            <input type="hidden" name="category_id" value="<?= $row['category_id'] ?>">
            <input type="submit" value="Delete">
          </form>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>

  <h3 style="color:orange">Add Category</h3>
  <form action="add_category.php" method="post">
    <label>Name: <input type="text" name="category_name" required></label>
    <input type="submit" value="Add">
  </form>

  <p><a href="index.php">List Products</a></p>
</div>
</body>
</html>
