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
    if(isset($_POST['joinus-btn'])){
        $id = unique_id();
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $number = $_POST['number'];
        $number = filter_var($number, FILTER_SANITIZE_STRING);
        
        
        $select_message = $conn->prepare( "SELECT * FROM `organization` WHERE name = ? AND user_id = ?");
        $select_message->execute([$name, $user_id]);
        
        if($select_message->rowCount() > 0){
           $warning_msg[] = 'You are already Join Organization!';
        }else{
            $insert_message = $conn->prepare( "INSERT INTO `organization`( user_id, name, email, number) VALUES(?,?,?,?)");
            $insert_message->execute([ $user_id, $name, $email, $number ]);
            $success_msg[] = 'Organization Join Successfully!';
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
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    
    <title>Green Coffee - Our Plants Page</title>
</head>
<body>
    <?php 
        include './components/header.php'; 
    ?>
    
    <div class="main"> 
        
    <div class="plants">
        <div class="content">
    <h1>Inspiring Action <br>
    to Save Nature</h1>
    <a href="#">DONATE TODAY!</a>
    </div>
    </div>
        




        <div class="title2">
            <a href="home.php">Home </a><span>/ Our Plants</span>
        </div>
       
       
        <div class="grass">
            
            <h1>Our Mission</h1>
            <p><b>The mission of our website and organization is to help people learn about the health and importance of trees. <br>
            Our website offers healthy products. we get some of orders then we plants some trees..<br> 
            if customers wants to donate us for tree plantation they can do.
            </b></p>
            <h2>How We Do It</h2>
            <p><b>when our website will get 300 orders then message will be send to the organization <br> then our team members will plant 50 trees and   whenever our <br> website will get  1000 subcribers
            then <br> our team will plants 100 trees </b> </p>
            
        </div>
        <section class="shop">
            <div class="title">
                <img src="./img/download.png" alt="">
                <h1>Our Plantation Photos</h1>
            </div>
        </section> 
            


        <div class="about-category">
            <div class="box1">
                <img src="./img/p1.jpg" alt="">
                
            </div>

            <div class="box1">
                <img src="./img/p3.jpg" alt="">
                
            </div>


            <div class="box1">
                <img src="./img/p4.jpg" alt="">
                
            </div>

            <div class="box1">
                <img src="./img/p5.jpg" alt="">
                
            </div>
        </div>

        <section class="shop">
            <div class="title">
                <img src="./img/download.png" alt="">
                <h1>Our Work</h1>
            </div>
        </section> 

        <div class="about1">
            <div class="row">
                <div class="img-box">
                    <img src="./img/o1.jpg" alt="">
                </div>
                <div class="detail">
                    <h1>Plantation Of Your Side</h1>
                    <p>our Organization help those people who  intrest in planting trees but they don't enough time or place for plantation so that for they can donate us and share there details like name and etc afte our team plants tree and share photo with them</p>
                    
                </div>
            </div>
        </div>


        <div class="about1">
            <div class="row">
            <div class="detail1">
                    <h1>Where We Plant</h1>
                    <p>in such particular spaces like our organization place ,government garden and hospitals </p>
                    
                </div>
                <div class="img-box1">
                    <img src="./img/o2.jpg" alt="">
                </div>
                
            </div>
        </div>

        <div class="about1">
            <div class="row">
                <div class="img-box">
                    <img src="./img/o3.jpg" alt="">
                </div>
                <div class="detail">
                    <h1>How We Manage Website and Organization</h1>
                    <p>Organization  collect information like how many orders and subscribers get in one day. after collect all information our organization team members plants a trees acording to information. </p>
                    
                </div>
            </div>
        </div>

        <div class="form-container">
            <form method="post">
                <div class="title">
                    <img src="./img/download.png" class="logo">
                    <h1>Join Our Organization</h1>
                </div>
                <div class="input-field">
                    <p>Your Name <sub>*</sub></p>
                    <input type="text" name="name" required>
                </div>
                <div class="input-field">
                    <p>Your Email <sub>*</sub></p>
                    <input type="email" name="email" required>
                </div>
                <div class="input-field">
                    <p>Your Number <sub>*</sub></p>
                    <input type="tel" name="number" required>
                </div>
               
                <button type="submit" name="joinus-btn" class="btn">Join Us</button>

            </form>
            
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