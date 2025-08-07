<?php
    include './components/connection.php';
    session_start();

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    }else{
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
    
    <title>Green Coffee - About Us Page</title>
</head>
<body>
    <?php 
        include './components/header.php'; 
    ?>
    <div class="main">
        <div class="banner">
            <h1>About Us</h1>
        </div>
        <div class="title2">
            <a href="home.php">Home </a><span>/ About</span>
        </div>
        <section class="shop">
            <div class="title">
                <img src="./img/download.png" alt="">
                <h1>Product Review</h1>
            </div>
        </section>    
        <div class="about-category">

        <div class="box">
                <img src="./img/organic green coffee beans 30.png" alt="">
                <div class="detail">
                    <h1>Organic Green <br> Coffee Beans </h1>
                    <p>Great quality organic green coffee beans! Fresh, rich flavor. Perfect for brewing at home. Highly recommend!</p>
                    
                </div>
            </div>

            <div class="box">
                <img src="./img/organic masala coffee 5.png" alt="">
                <div class="detail">
                    <h1>Organic Masala <br>Coffee</h1>
                    <p>The organic masala coffee has a rich, aromatic flavor. Perfect blend of spices, smooth taste, and refreshing kick!</p>
                    
                </div>
            </div>
            


            <div class="box">
                <img src="./img/organic herbal coffee 7.png" alt="">
                <div class="detail">
                    <h1>Organic Herbal <br> Coffee</h1>
                    <p>Rich, smooth flavor with natural ingredients. Feels energizing without jitters. A perfect herbal coffee alternative!</p>
                   
                </div>
            </div>

            <div class="box">
                <img src="./img/organic beans 1.png" alt="">
                <div class="detail">
                    
                    <h1>Organic Beans</h1>
                    <p>These organic beans are fresh, flavorful, and perfect for cooking. Great quality and well worth the price!</p>
                    
                </div>
            </div>

            
        </div>

        <section class="services">
            <div class="title">
                <img src="./img/download.png" class="logo" alt="">
                <h1>Why Choose Us</h1>
                <p>Choose us for premium green coffee, sustainably sourced and packed with flavor. Our commitment to quality ensures you enjoy the health benefits in every delicious cup. Elevate your coffee experience today</p>
            </div>
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

        <div class="about">
            <div class="row">
                <div class="img-box">
                    <img src="./img/3.png" alt="">
                </div>
                <div class="detail">
                    <h1>visit our beautiful showroom!</h1>
                    <p>Our Showroom is an expression of what we love doing; being creative with floral and plant arrangements.
                        Whether you are looking for a florist for your perfect wedding, or just want to uplift any room with some
                    one of a kind living decor, Blossom with love can help. </p>
                    <a href="view_products.php" class="btn">Shop Now</a>
                </div>
            </div>
        </div>
        <div class="testimonial-container">
            <div class="title">
                <img src="./img/download.png" alt="">
                <h1>what people say about us</h1>
                <p>What Our Customers Are Saying About Us</p>
            </div>
                <div class="container">
                    <div class="testimonial-item active">
                        <img src="./img/01.jpg" alt="">
                        <h1>Khushi Rupapara</h1>
                        <p>Absolutely love this green coffee! The flavor is smooth and rich, 
                            and I feel more energized throughout the day without the jitters. 
                            It’s become my go-to morning beverage. Highly recommend!</p>
                    </div>

                    <div class="testimonial-item ">
                        <img src="./img/02.jpg" alt="">
                        <h1>Deep Vaghasiya</h1>
                        <p>I was skeptical at first, but this green coffee exceeded my expectations! 
                            It’s refreshing and has helped boost my metabolism. Plus, I appreciate the sustainable sourcing. 
                            Will definitely purchase again!"</p>
                    </div>

                    <div class="testimonial-item ">
                        <img src="./img/03.jpg" alt="">
                        <h1>Priya Patel</h1>
                        <p>Fantastic product! The aroma is delightful, and the taste is exceptional. 
                            I’ve noticed a positive difference in my focus and energy levels. A must-try for any coffee lover!</p>
                    </div>

                    <div class="testimonial-item ">
                        <img src="./img/04.png" alt="">
                        <h1>Kaxxa Vaghasiya</h1>
                        <p>I've tried several green coffees, but this one stands out. It’s perfectly balanced and gives me a great start to my day. 
                            Great quality and fast shipping!</p>
                    </div>
                    <div class="left-arrow" onclick="nextSlide()"><i class="bx bxs-left-arrow-alt"></i></div>
                    <div class="right-arrow" onclick="prevSlide()"><i class="bx bxs-right-arrow-alt"></i></div>
                </div>
        </div>




    <?php include './components/footer.php'; ?>
        
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
let slides = document.querySelectorAll('.testimonial-item');
let index = 0;

function nextSlide(){
    slides[index].classList.remove('active');
    index = (index + 1) % slides.length;
    slides[index].classList.add('active');
}
function prevSlide(){
    slides[index].classList.remove('active');
    index = (index - 1 + slides.length) % slides.length;
    slides[index].classList.add('active');
} 
   </script>
    <?php include './components/alert.php'; ?>
</body>
</html>