<?php
    include './components/connection.php';
    session_start();
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    // Users can access the home page even if they are not logged in

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
    
    <title>Green Coffee - Home Page</title>
</head>
<body>
    <?php 
        include './components/header.php'; 
    ?>
    <div class="main">
        
    

        <section class="home-section">
        <div class="slider">
            <div class="slider__slider slider1">
                <div class="overlay"></div>
                <div class="slider-detail">
                <h1>Spread joy with a cup of coffee</h1>
                <p>Discover the rich flavor and health benefits of green coffee today!</p>
                    <a href="view_products.php" class="btn">Shop Now</a>
                </div>
                <div class="hero-dec-top"></div>
                <div class="hero-dec-bottom"></div>
            </div>

            <div class="slider__slider slider2">
                <div class="overlay"></div>
                <div class="slider-detail">
                <h1>Coffee time is cuddle time</h1>
                <p>Enjoy a natural energy boost without the jitters.</p>
                    <a href="view_products.php" class="btn">Shop Now</a>
                </div>
                <div class="hero-dec-top"></div>
                <div class="hero-dec-bottom"></div>
            </div>

            <div class="slider__slider slider3">
                <div class="overlay"></div>
                <div class="slider-detail">
                <h1>Wake up and be awesome!</h1>
                <p>Join the green coffee revolution and elevate your daily routine!</p>
                    <a href="view_products.php" class="btn">Shop Now</a>
                </div>
                <div class="hero-dec-top"></div>
                <div class="hero-dec-bottom"></div>
            </div>

            <div class="slider__slider slider4">
                <div class="overlay"></div>
                <div class="slider-detail">
                <h1>Start your day with a sip of sunshine</h1>
                <p>Savor the unique taste of freshly sourced green coffee beans.</p>
                    <a href="view_products.php" class="btn">Shop Now</a>
                </div>
                <div class="hero-dec-top"></div>
                <div class="hero-dec-bottom"></div>
            </div>

            <div class="slider__slider slider5">
                <div class="overlay"></div>
                <div class="slider-detail">
                <h1>Find Your Flavor</h1>
                <p>Unlock the power of green coffee for a healthier you!</p>
                    <a href="view_products.php" class="btn">Shop Now</a>
                </div>
                <div class="hero-dec-top"></div>
                <div class="hero-dec-bottom"></div>
            </div>

            <!------------slide end-------------------------->

            <div class="left-arrow"><i class="bx bxs-left-arrow"></i></div>
            <div class="right-arrow"><i class="bx bxs-right-arrow"></i></div>
        </div>
        </section>
        <!--------------------home slider end------------->

        <section class="thumb">
            <div class="box-container">
                <div class="box">
                    <img src="./img/thumb2.jpg" alt="">
                    <h3>Herbal Coffee</h3>
                    <p>Experience nature's energy boost with the pure taste of herbal coffee.</p>
                    <i class="bx bx-chevron-right"></i>
                </div>

                <div class="box">
                    <img src="./img/thumb0.jpg" alt="">
                    <h3>Healthy Coffee</h3>
                    <p> Awaken your senses with our healthy coffee—where flavor meets vitality in every sip!</p>
                    <i class="bx bx-chevron-right"></i>
                </div>

                <div class="box">
                    <img src="./img/thumb1.jpg" alt="">
                    <h3>Green Coffee</h3>
                    <p>Experience the rich flavor and invigorating benefits of green coffee for a natural energy lift!</p>
                    <i class="bx bx-chevron-right"></i>
                </div>

                <div class="box">
                    <img src="./img/thumb.jpg" alt="">
                    <h3>Coffee Beans</h3>
                    <p>Awaken your senses with freshly roasted coffee beans, brewed to perfection daily.</p>
                    <i class="bx bx-chevron-right"></i>
                </div>
            </div>
        </section>
        <section class="container">
            <div class="box-container">
                <div class="box">
                    <img src="./img/about-us.jpg" alt="">
                </div>
                <div class="box">
                    <img src="./img/download.png" alt="">
                    <span>Healthy Coffee</span>
                    <h1>save up to 50% off</h1>
                    <p>Enjoy our healthy coffee and save up to 50% off! Experience rich flavors and energizing benefits that enhance your wellness journey. Don’t miss out!</p>
                </div>
            </div>
        </section>
        <section class="shop">
            <div class="title">
                <img src="./img/download.png" alt="">
                <h1>Trending Products</h1>
            </div>
            <div class="row">
                <img src="./img/about1.jpg" alt="">
                <div class="row-details">
                    <img src="./img/basil.jpg" alt="">
                    <div class="top-footer">
                        <h1>a cup of green Coffee makes you healthy</h1>
                    </div>
                </div>
            </div>
            <div class="box-container">
                <div class="box">
                    <img src="./img/card.jpg" alt="">
                    <a href="view_products.php" class="btn">Shop Now</a>
                </div>

                <div class="box">
                    <img src="./img/card0.jpg" alt="">
                    <a href="view_products.php" class="btn">Shop Now</a>
                </div>

                <div class="box">
                    <img src="./img/card1.jpg" alt="">
                    <a href="view_products.php" class="btn">Shop Now</a>
                </div>

                <div class="box">
                    <img src="./img/card2.jpg" alt="">
                    <a href="view_products.php" class="btn">Shop Now</a>
                </div>

                <div class="box">
                    <img src="./img/10.jpg" alt="">
                    <a href="view_products.php" class="btn">Shop Now</a>
                </div>

                <div class="box">
                    <img src="./img/6.webp" alt="">
                    <a href="view_products.php" class="btn">Shop Now</a>
                </div>
            </div>
        </section>

        <section class="shop-category">
            <div class="box-container">
                <div class="box">
                    <img src="./img/6.jpg" alt="">
                    <div class="detail">
                        <span>BIG OFFERS</span>
                        <h1>Extra 15% Off</h1>
                        <a href="view_products.php" class="btn">Shop Now</a>
                    </div>
                </div>

                <div class="box">
                    <img src="./img/7.jpg" alt="">
                    <div class="detail">
                        <span>New In Taste</span>
                        <h1>Coffe House</h1>
                        <a href="view_products.php" class="btn">Shop Now</a>
                    </div>
                </div>
            </div>
            
        </section>
        <section class="services">
            <div class="box-container">
                <div class="box">
                    <img src="./img/icon2.png" alt="">
                    <div class="detail">
                        <h3>Great Savings</h3>
                        <p>save big every order</p>
                    </div>
                </div>

                <div class="box">
                    <img src="./img/icon1.png" alt="">
                    <div class="detail">
                        <h3>24*7 Support</h3>
                        <p>one-on-one support</p>
                    </div>
                </div>

                <div class="box">
                    <img src="./img/icon0.png" alt="">
                    <div class="detail">
                        <h3>Gift Vouchers</h3>
                        <p>vouchers on every festivals</p>
                    </div>
                </div>

                <div class="box">
                    <img src="./img/icon.png" alt="">
                    <div class="detail">
                        <h3>Cash On Delivery</h3>
                        <p>all india delivery</p>
                    </div>
                </div>                
            </div>
        </section>

        <section class="brand">
            <div class="box-container">
                <div class="box">
                    <img src="./img/brand (1).jpg" alt="">
                </div>
                <div class="box">
                    <img src="./img/brand (2).jpg" alt="">
                </div>
                <div class="box">
                    <img src="./img/brand (3).jpg" alt="">
                </div>
                <div class="box">
                    <img src="./img/brand (4).jpg" alt="">
                </div>
                <div class="box">
                    <img src="./img/brand (5).jpg" alt="">
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