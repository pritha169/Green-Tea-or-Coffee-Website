<?php
include './components/connection.php';
session_start();

$user_id = $_SESSION['user_id'] ?? '';

// Logout
if (isset($_POST['logout'])) {
    session_destroy();
    header('location: login.php');
}

// Add to Wishlist
if (isset($_POST['add_to_wishlist'])) {
    $id = unique_id();
    $product_id = $_POST['product_id'];

    $verify_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ? AND product_id = ?");
    $verify_wishlist->execute([$user_id, $product_id]);

    if ($verify_wishlist->rowCount() > 0) {
        $warning_msg[] = 'Product already exists in your wishlist';
    } else {
        $select_price = $conn->prepare("SELECT * FROM `products` WHERE product_id = ? LIMIT 1");
        $select_price->execute([$product_id]);
        $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

        $insert_wishlist = $conn->prepare("INSERT INTO `wishlist` (wishlist_id, user_id, product_id, price) VALUES (?, ?, ?, ?)");
        $insert_wishlist->execute([$id, $user_id, $product_id, $fetch_price['price']]);
        $success_msg[] = 'Product added to wishlist successfully';
    }
}

// Add to Cart
if (isset($_POST['add_to_cart'])) {
    $id = unique_id();
    $product_id = $_POST['product_id'];
    $qty = filter_var($_POST['qty'], FILTER_SANITIZE_NUMBER_INT);

    $verify_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ? AND product_id = ?");
    $verify_cart->execute([$user_id, $product_id]);

    $max_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $max_cart_items->execute([$user_id]);

    if ($verify_cart->rowCount() > 0) {
        $warning_msg[] = 'Product already exists in your cart';
    } else if ($max_cart_items->rowCount() >= 20) {
        $warning_msg[] = 'Cart is full';
    } else {
        $select_price = $conn->prepare("SELECT * FROM `products` WHERE product_id = ? LIMIT 1");
        $select_price->execute([$product_id]);
        $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

        $insert_cart = $conn->prepare("INSERT INTO `cart` (cart_id, user_id, product_id, price, qty) VALUES (?, ?, ?, ?, ?)");
        $insert_cart->execute([$id, $user_id, $product_id, $fetch_price['price'], $qty]);
        $success_msg[] = 'Product added to cart successfully';
    }
}
?>

<style type="text/css">
<?php include './style.css'; ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Coffee - Product Detail</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>
<body>
    <?php include './components/header.php'; ?>

    <div class="main">
        <div class="banner">
            <h1>Product Detail</h1>
        </div>

        <div class="title2">
            <a href="home.php">Home </a><span>/ Product Detail</span>
        </div>

        <section class="view_page">
            <?php
            if (isset($_GET['get_id'])) {
                $pid = $_GET['get_id'];
                $select_products = $conn->prepare("SELECT * FROM `products` WHERE product_id = ?");
                $select_products->execute([$pid]);

                if ($select_products->rowCount() > 0) {
                    while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <form action="" method="post">
                <img src="img/<?php echo $fetch_products['image']; ?>" class="img" alt="">
                <div class="detail">
                    <div class="price">₹<?php echo $fetch_products['price']; ?>/-</div>
                    <div class="name"><?php echo $fetch_products['name']; ?></div>
                    <div class="detail">
                        <p><?php echo $fetch_products['product_details']; ?></p>
                    </div>
                    <input type="hidden" name="product_id" value="<?php echo $fetch_products['product_id']; ?>">
                    <div class="button">
                        <button type="submit" name="add_to_wishlist" class="btn">Add to Wishlist <i class="bx bx-heart"></i></button>
                        <input type="hidden" name="qty" value="1" min="1" class="quantity">
                        <button type="submit" name="add_to_cart" class="btn">Add to Cart <i class="bx bx-cart"></i></button>
                    </div>
                </div>
            </form>
            <?php
                    }
                } else {
                    echo "<p style='text-align:center;'>Product not found.</p>";
                }
            } else {
                echo "<p style='text-align:center;'>No product selected.</p>";
            }
            ?>
        </section>

        <?php include './components/footer.php'; ?>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="./script.js"></script>
    <?php include './components/alert.php'; ?>
</body>
</html>
