<?php include '../view/header.php'; ?>
<main>
    <h1>My Guitar Shop</h1>
    <h2>Category List</h2>
    
    <table>
        <tr>
            <th>Name</th>
            <th>&nbsp;</th>
        </tr>
        
        <?php foreach ($categories as $category) : ?>
        <tr>
            <td><?php echo $category['categoryName']; ?></td>
            <td>
                <form action="index.php" method="post" style="display: inline;">
                    <input type="hidden" name="action" value="delete_category">
                    <input type="hidden" name="category_id" 
                           value="<?php echo $category['categoryID']; ?>">
                    <input type="submit" value="Delete">
                </form>
                <a href="index.php?action=show_edit_category_form&category_id=<?php echo $category['categoryID']; ?>">Edit</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Add Category</h2>
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="add_category">

        <label>Name:</label>
        <input type="text" name="name">
        <input type="submit" value="Add">
    </form>

    <p><a href="index.php">List Products</a></p>

</main>
<?php include '../view/footer.php'; ?>