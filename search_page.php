<?php
include './components/connection.php';
session_start();

$user_id = $_SESSION['user_id'] ?? '';

$search_term = '';
$results = [];

if (isset($_GET['search'])) {
    $search_term = $_GET['search'];
    $stmt = $conn->prepare("SELECT * FROM `products` WHERE name LIKE ?");
    $stmt->execute(["%$search_term%"]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include './components/header.php'; ?>

    <div class="main">
        <h2>Search Products</h2>
        <form method="get" action="search_page.php">
            <input type="text" name="search" placeholder="Enter product name" value="<?= htmlspecialchars($search_term) ?>" required>
            <button type="submit">Search</button>
        </form>

        <div class="products">
            <?php if ($results): ?>
                <?php foreach ($results as $product): ?>
                    <div class="product-card">
                        <img src="img/<?= $product['image']; ?>" alt="">
                        <h3><?= $product['name']; ?></h3>
                        <p>₹<?= $product['price']; ?></p>
                        <a href="view_page.php?get_id=<?= $product['product_id']; ?>" class="btn">View Details</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No products found.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php include './components/footer.php'; ?>
</body>
</html>
