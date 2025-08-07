<?php
    include './components/connection.php';
    session_start();

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id = '';
    }

    //register user

    if (isset($_POST['submit'])) {
        
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $pass = $_POST['pass'];
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);
        
        $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
        $select_user->execute([$email, $pass]);
        $row = $select_user->fetch(PDO::FETCH_ASSOC);

        if ($select_user->rowCount() > 0) {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            header('location: home.php');
        }else{
            $warning_msg[] = 'incorrect username or password';
            echo 'incorrect username or password';
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
    <link rel="stylesheet" type="text/css" href="./style.css?v=<?php echo time(); ?>">
    <title>Green Coffee - Login Now</title>
</head>
<body>
    <div class="main-container">
        <section class="form-container">
            <div class="title">
                <img src="./img/download.png" alt="">
                <h1>Login Now</h1>
                <p>Login Now and Boost Your Day with Green Coffee!</p>
            </div>
            <form action="" method="post">
                

                <div class="input-field">
                    <p>Your Email <sub>*</sub></p>
                    <input type="email" name="email" required placeholder="Enter Your Email" maxlength="50"
                    oninput="this.value = this.value.replace(/\s/g, '')">
                </div>

                <div class="input-field">
                    <p>Your Password <sub>*</sub></p>
                    <input type="password" name="pass" required placeholder="Enter Your Password" maxlength="50"
                    oninput="this.value = this.value.replace(/\s/g, '')">
                </div>

                
                <input type="submit" name="submit" value="Login now" class="btn">
                <p>do not have an account? <a href="register.php">Register Now</a></p>
            </form>
        </section>
    </div>
    <?php include './components/alert.php';?>
</body>
</html>