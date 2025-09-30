<?php include '../view/header.php'; ?>
<main>
    <h1>My Guitar Shop</h1>
    <h2>Add Product</h2>
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="add_product">

        <label>Category:</label>
        <select name="category_id">
        <?php foreach ($categories as $category) : ?>
            <option value="<?php echo $category['categoryID']; ?>">
                <?php echo $category['categoryName']; ?>
            </option>
        <?php endforeach; ?>
        </select><br>

        <label>Code:</label>
        <input type="text" name="code"><br>

        <label>Name:</label>
        <input type="text" name="name"><br>

        <label>List Price:</label>
        <input type="text" name="price"><br>

        <label>&nbsp;</label>
        <input type="submit" value="Add Product"><br>
    </form>
    <p><a href="index.php">View Product List</a></p>
</main>
<?php include '../view/footer.php'; ?>