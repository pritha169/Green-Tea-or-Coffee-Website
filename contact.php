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
    exit;
}

if (isset($_POST['submit-btn'])) {
    $id = unique_id();

    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
    $msg = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

    // Server-side phone number validation for Bangladesh
    if (!preg_match('/^01[3-9][0-9]{8}$/', $number)) {
        $warning_msg[] = 'Please enter a valid Bangladeshi phone number (e.g. 017XXXXXXXX).';
    } else {
        $select_message = $conn->prepare("SELECT * FROM `message` WHERE name = ? AND message = ?");
        $select_message->execute([$name, $msg]);

        if ($select_message->rowCount() > 0) {
            $warning_msg[] = 'Message sent already!';
        } else {
            $insert_message = $conn->prepare("INSERT INTO `message` (message_id, user_id, name, email, number, message) VALUES (?, ?, ?, ?, ?, ?)");
            $insert_message->execute([$id, $user_id, $name, $email, $number, $msg]);
            $success_msg[] = 'Message sent successfully!';
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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" />
    <title>Green Coffee - Contact Us Page</title>
</head>
<body>
    <?php include './components/header.php'; ?>

    <div class="main">
        <div class="banner">
            <h1>Contact Us</h1>
        </div>
        <div class="title2">
            <a href="home.php">Home </a><span>/ Contact Us</span>
        </div>

        <section class="services">
            <div class="box-container">
                <!-- Your info boxes here -->
                <div class="box">
                    <img src="./img/icon2.png" alt="" />
                    <div class="detail">
                        <h3>Great Savings</h3>
                        <p>Save big every order</p>
                    </div>
                </div>
                <div class="box">
                    <img src="./img/icon1.png" alt="" />
                    <div class="detail">
                        <h3>24*7 Support</h3>
                        <p>One-on-one support</p>
                    </div>
                </div>
                <div class="box">
                    <img src="./img/icon0.png" alt="" />
                    <div class="detail">
                        <h3>Gift Vouchers</h3>
                        <p>Vouchers on every festival</p>
                    </div>
                </div>
                <div class="box">
                    <img src="./img/icon.png" alt="" />
                    <div class="detail">
                        <h3>Cash On Delivery</h3>
                        <p>All India delivery</p>
                    </div>
                </div>
            </div>
        </section>

        <div class="form-container">
            <form method="post" id="contactForm" novalidate>
                <div class="title">
                    <img src="./img/download.png" class="logo" alt="logo" />
                    <h1>Leave A Message</h1>
                </div>

                <?php
                // Display messages
                if (!empty($warning_msg)) {
                    foreach ($warning_msg as $warning) {
                        echo '<p style="color:red; text-align:center;">' . htmlspecialchars($warning) . '</p>';
                    }
                }
                if (!empty($success_msg)) {
                    foreach ($success_msg as $success) {
                        echo '<p style="color:green; text-align:center;">' . htmlspecialchars($success) . '</p>';
                    }
                }
                ?>

                <div class="input-field">
                    <p>Your Name <sub>*</sub></p>
                    <input type="text" name="name" required />
                </div>
                <div class="input-field">
                    <p>Your Email <sub>*</sub></p>
                    <input type="email" name="email" required />
                </div>
                <div class="input-field">
                    <p>Your Number <sub>*</sub></p>
                    <input
                        type="tel"
                        name="number"
                        id="number"
                        required
                        pattern="01[3-9][0-9]{8}"
                        maxlength="11"
                        title="Enter a valid Bangladesh number, e.g. 017XXXXXXXX"
                    />
                    <small id="numberError" style="color:red; display:none;">Invalid Bangladesh number.</small>
                </div>
                <div class="input-field">
                    <p>Your Message <sub>*</sub></p>
                    <textarea name="message" required></textarea>
                </div>
                <button type="submit" name="submit-btn" class="btn">Send Message</button>
            </form>
        </div>

        <div class="address">
            <div class="title">
                <img src="./img/download.png" class="logo" alt="logo" />
                <h1>Contact Detail</h1>
                <p>Reach Out to Us for Questions or Support Anytime!</p>
            </div>
            <div class="box-container">
                <div class="box">
                    <i class="bx bxs-map-pin"></i>
                    <div>
                        <h4>Address</h4>
                        <p>Vadodara</p>
                    </div>
                </div>

                <div class="box">
                    <i class="bx bxs-phone-call"></i>
                    <div>
                        <h4>Phone Number</h4>
                        <p>6351505351</p>
                    </div>
                </div>

                <div class="box">
                    <i class="bx bxl-gmail"></i>
                    <div>
                        <h4>Email</h4>
                        <p>greencoffee@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>

        <?php include './components/footer.php'; ?>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="./script.js"></script>

    <script>
        // Real-time validation of Bangladeshi number on client side
        const numberInput = document.getElementById('number');
        const numberError = document.getElementById('numberError');
        const form = document.getElementById('contactForm');

        function validateBDNumber(number) {
            return /^01[3-9][0-9]{8}$/.test(number);
        }

        numberInput.addEventListener('input', () => {
            if (!validateBDNumber(numberInput.value)) {
                numberError.style.display = 'inline';
            } else {
                numberError.style.display = 'none';
            }
        });

        form.addEventListener('submit', (e) => {
            if (!validateBDNumber(numberInput.value)) {
                e.preventDefault();
                alert('Please enter a valid Bangladeshi phone number (e.g. 017XXXXXXXX).');
                numberInput.focus();
            }
        });
    </script>

    <?php include './components/alert.php'; ?>
</body>
</html>
