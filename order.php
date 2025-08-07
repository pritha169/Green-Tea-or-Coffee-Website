<?php
include './components/connection.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('location: login.php');
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
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <title>Green Coffee - Order Page</title>
</head>
<body>
    <?php include './components/header.php'; ?>

    <div class="main">
        <div class="banner">
            <h1>My Order</h1>
        </div>
        <div class="title2">
            <a href="home.php">Home </a><span>/ Order</span>
        </div>

        <section class="orders">
            <div class="title">
                <img src="./img/download.png" alt="" class="logo">
                <h1>My Orders</h1>
                <p>Track your order status, view details, and manage your purchases easily. Stay updated on delivery and enjoy your green coffee</p>
            </div>

            <div class="box-container">
                <?php
                $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ? ORDER BY date DESC");
                $select_orders->execute([$user_id]);

                if ($select_orders->rowCount() > 0) {
                    while ($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)) {
                        $select_products = $conn->prepare("SELECT * FROM `products` WHERE product_id = ?");
                        $select_products->execute([$fetch_order['product_id']]);

                        if ($select_products->rowCount() > 0) {
                            while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="box" <?php if ($fetch_order['status'] == 'canceled') echo 'style="border:2px solid red;"'; ?>>
                    <a href="view_order.php?get_id=<?= $fetch_order['order_id']; ?>">
                        <p class="date">
                            <i class="bi bi-calendar-fill"></i>
                            <span><?= htmlspecialchars($fetch_order['date']); ?></span>
                        </p>
                        <img src="img/<?= htmlspecialchars($fetch_product['image']); ?>" alt="" class="img">
                        <div class="row">
                            <h3 class="name"><?= htmlspecialchars($fetch_product['name']); ?></h3>
                            <p class="price">Price: ৳<?= $fetch_order['price']; ?> x <?= $fetch_order['qty']; ?></p>
                            <p class="status" style="color:<?= $fetch_order['status'] == 'canceled' ? 'red' : 'green'; ?>">
                                Status: <?= ucfirst($fetch_order['status']); ?>
                            </p>
                        </div>
                    </a>
                </div>
                <?php
                            }
                        }
                    }
                } else {
                    echo '<p class="empty">No order has been placed yet!</p>';
                }
                ?>
            </div>
        </section>

        <?php include './components/footer.php'; ?>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="./script.js"></script>
    <?php include './components/alert.php'; ?>
</body>
</html>
