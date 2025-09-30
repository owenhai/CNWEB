<?php include '../view/header.php'; ?>
<main>
    <h1>My Guitar Shop</h1>
    <h2>Edit Category</h2>
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="update_category">
        <input type="hidden" name="category_id" value="<?php echo $category['categoryID']; ?>">

        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($category['categoryName']); ?>">
        <input type="submit" value="Update Category">
    </form>
    
    <p><a href="index.php?action=list_categories">Cancel</a></p>
</main>
<?php include '../view/footer.php'; ?>