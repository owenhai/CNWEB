<?php
// index.php (main entry point)
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <header><h1>My Guitar Shop</h1></header>
    <main>
        <nav>
            <ul>
                <li><a href="product_manager">Product Manager</a></li>
                <li><a href="product_catalog">Product Catalog</a></li>
            </ul>
        </nav>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
    </footer>
</body>
</html>