<?php
include './components/connection.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Fetch user details
    $fetch_user = $conn->prepare("SELECT name, email FROM users WHERE user_id = ?");
    $fetch_user->execute([$user_id]);
    $user_data = $fetch_user->fetch(PDO::FETCH_ASSOC);

    $default_name = $user_data['name'] ?? '';
    $default_email = $user_data['email'] ?? '';
} else {
    $user_id = '';
    $default_name = '';
    $default_email = '';
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('location: login.php');
}

if (isset($_POST['place_order'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $address = $_POST['flat'] . ', ' . $_POST['street'] . ', ' . $_POST['city'] . ', ' . $_POST['country'] . ', ' . $_POST['pincode'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);
    $address_type = filter_var($_POST['address_type'], FILTER_SANITIZE_STRING);
    $method = filter_var($_POST['method'], FILTER_SANITIZE_STRING);
    $date = date("Y-m-d");
    $pay = 'pending';

    if (!preg_match('/^01[3-9][0-9]{8}$/', $number)) {
        $warning_msg[] = 'Invalid Bangladeshi mobile number!';
    } else {
        $varify_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
        $varify_cart->execute([$user_id]);

        if (isset($_GET['get_id'])) {
            $get_product = $conn->prepare("SELECT * FROM `products` WHERE product_id = ? LIMIT 1");
            $get_product->execute([$_GET['get_id']]);
            if ($get_product->rowCount() > 0) {
                while ($fetch_p = $get_product->fetch(PDO::FETCH_ASSOC)) {
                    $insert_order = $conn->prepare("INSERT INTO `orders`(order_id, user_id, name, number, email, address, address_type, method, product_id, price, qty, date, status) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
                    $insert_order->execute([unique_id(), $user_id, $name, $number, $email, $address, $address_type, $method, $fetch_p['product_id'], $fetch_p['price'], 1, $date, $pay]);
                }
                $success_msg[] = 'Thank You For Your Contribution In Tree Plantation!';
                header('location: order.php');
            } else {
                $warning_msg[] = 'Something went wrong';
            }
        } elseif ($varify_cart->rowCount() > 0) {
            while ($f_cart = $varify_cart->fetch(PDO::FETCH_ASSOC)) {
                $insert_order = $conn->prepare("INSERT INTO `orders`(order_id, user_id, name, number, email, address, address_type, method, product_id, price, qty, date, status) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
                $insert_order->execute([unique_id(), $user_id, $name, $number, $email, $address, $address_type, $method, $f_cart['product_id'], $f_cart['price'], $f_cart['qty'], $date, $pay]);
            }
            $delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
            $delete_cart_id->execute([$user_id]);
            $success_msg[] = 'Thank You For Your Contribution In Tree Plantation!';
            header('location: order.php');
        } else {
            $warning_msg[] = 'Your cart is empty!';
        }
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
    <title>Green Coffee - Checkout Page</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>
<body>
<?php include './components/header.php'; ?>
<div class="main">
    <div class="banner">
        <h1>checkout summary</h1>
    </div>
    <div class="title2">
        <a href="home.php">Home </a><span>/ checkout summary</span>
    </div>
    <section class="checkout">
        <div class="title">
            <img src="./img/download.png" alt="" class="logo">
            <h1>Checkout Summary</h1>
            <p>Review your checkout summary, including item totals, shipping costs, and estimated delivery. Complete your purchase and enjoy your green coffee!</p>
        </div>
        <div class="row">
            <form action="" method="post">
                <h3>Billing Details</h3>
                <div class="flex">
                    <div class="box">
                        <div class="input-field">
                            <p>Your Name <span>*</span></p>
                            <input type="text" name="name" required maxlength="50" placeholder="Enter Your Name" class="input" value="<?= htmlspecialchars($default_name) ?>">
                        </div>
                        <div class="input-field">
                            <p>Your Number <span>*</span></p>
                            <input type="text" name="number" required pattern="01[3-9][0-9]{8}" maxlength="11" title="Enter a valid Bangladeshi number e.g. 017XXXXXXXX" placeholder="01XXXXXXXXX" class="input">
                        </div>
                        <div class="input-field">
                            <p>Your Email <span>*</span></p>
                            <input type="email" name="email" required maxlength="50" placeholder="Enter Your Email" class="input" value="<?= htmlspecialchars($default_email) ?>">
                        </div>
                        <div class="input-field">
                            <p>Payment Method <span>*</span></p>
                            <select name="method" class="input">
                                <option value="cash on delivery">Cash On Delivery</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <p>Address Type <span>*</span></p>
                            <select name="address_type" class="input">
                                <option value="home">Home</option>
                                <option value="office">Office</option>
                            </select>
                        </div>
                    </div>
                    <div class="box">
                        <div class="input-field">
                            <p>Address Line 01 <span>*</span></p>
                            <input type="text" name="flat" required maxlength="50" placeholder="e.g Flat & Building Number" class="input">
                        </div>
                        <div class="input-field">
                            <p>Address Line 02 <span>*</span></p>
                            <input type="text" name="street" required maxlength="50" placeholder="e.g Street Name" class="input">
                        </div>
                        <div class="input-field">
                            <p>City Name <span>*</span></p>
                            <input type="text" name="city" required maxlength="50" placeholder="Enter Your City Name" class="input">
                        </div>
                        <div class="input-field">
                            <p>Country Name <span>*</span></p>
                            <input type="text" name="country" required maxlength="50" placeholder="Enter Your Country Name" class="input">
                        </div>
                        <div class="input-field">
                            <p>Pincode <span>*</span></p>
                            <input type="text" name="pincode" required maxlength="6" placeholder="e.g. 1216" class="input">
                        </div>
                    </div>
                </div>
                <button type="submit" name="place_order" class="btn">Place Order</button>
            </form>
            <div class="summary">
                <h3>My Bag</h3>
                <div class="box-container">
                    <?php
                    $grand_total = 0;
                    if (isset($_GET['get_id'])) {
                        $select_get = $conn->prepare("SELECT * FROM `products` WHERE product_id = ?");
                        $select_get->execute([$_GET['get_id']]);
                        while ($fetch_get = $select_get->fetch(PDO::FETCH_ASSOC)) {
                            $sub_total = $fetch_get['price'];
                            $grand_total += $sub_total;
                            ?>
                            <div class="flex">
                                <img src="img/<?= $fetch_get['image']; ?>" class="image" alt="">
                                <div>
                                    <h3 class="name"><?= $fetch_get['name']; ?></h3>
                                    <p class="price">৳<?= $fetch_get['price']; ?>/-</p>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                        $select_cart->execute([$user_id]);
                        if ($select_cart->rowCount() > 0) {
                            while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                                $select_products = $conn->prepare("SELECT * FROM `products` WHERE product_id = ?");
                                $select_products->execute([$fetch_cart['product_id']]);
                                $fetch_product = $select_products->fetch(PDO::FETCH_ASSOC);
                                $sub_total = ($fetch_cart['qty'] * $fetch_product['price']);
                                $grand_total += $sub_total;
                                ?>
                                <div class="flex">
                                    <img src="img/<?= $fetch_product['image']; ?>" alt="" class="image">
                                    <div>
                                        <h3 class="name"><?= $fetch_product['name']; ?></h3>
                                        <p class="price">৳<?= $fetch_product['price']; ?> x <?= $fetch_cart['qty']; ?></p>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo '<p class="empty">Your cart is empty</p>';
                        }
                    }
                    ?>
                </div>
                <div class="grand-total"><span>Total Amount Payable: </span>৳<?= $grand_total ?>/-</div>
            </div>
        </div>
    </section>

    <?php include './components/footer.php'; ?>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="./script.js"></script>
<?php include './components/alert.php'; ?>
</body>
</html>
