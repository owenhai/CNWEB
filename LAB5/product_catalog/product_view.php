<?php include '../view/header.php'; ?>
<main>
    <h1>My Guitar Shop</h1>
    <aside>
        <!-- display a list of categories -->
        <h2>Categories</h2>
        <?php include '../view/categories_nav.php'; ?>
    </aside>

    <section>
        <!-- display product -->
        <h2><?php echo $product['productName']; ?></h2>
        <div id="product_image">
            <img src="../images/<?php echo $product['productCode']; ?>.png"
                 alt="<?php echo $product['productName']; ?>" />
        </div>
        <p><b>List Price:</b> $<?php echo $product['listPrice']; ?></p>
        <form action="../cart" method="post">
            <input type="hidden" name="action" value="add">
            <input type="hidden" name="product_id"
                   value="<?php echo $product['productID']; ?>">
            <b>Quantity:</b>
            <input id="quantity" type="text" name="quantity" 
                   value="1" size="2">
            <br><br>
            <input type="submit" value="Add to Cart">
        </form>
    </section>
</main>
<?php include '../view/footer.php'; ?>