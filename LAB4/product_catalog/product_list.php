<?php include '../view/header.php'; ?>
<main>
    <h1>My Guitar Shop</h1>
    <aside>
        <!-- display a list of categories -->
        <h2>Categories</h2>
        <?php include '../view/categories_nav.php'; ?>
    </aside>

    <section>
        <!-- display a table of products -->
        <h2><?php echo $category_name; ?></h2>
        <table>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th class="right">Price</th>
            </tr>
            
            <?php foreach ($products as $product) : ?>
            <tr>
                <td><?php echo $product['productCode']; ?></td>
                <td><?php echo $product['productName']; ?></td>
                <td class="right">$<?php echo $product['listPrice']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </section>
</main>
<?php include '../view/footer.php'; ?>