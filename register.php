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
        $id = unique_id();
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $pass = $_POST['pass'];
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);
        $cpass = $_POST['cpass'];
        $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

        $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
        $select_user->execute([$email]);
        $row = $select_user->fetch(PDO::FETCH_ASSOC);

        if ($select_user->rowCount() > 0) {
            $warning_msg[] = 'email alredy exist';
            echo 'email alredy exist';
            
        }else{
            if($pass != $cpass){
                $warning_msg[] = 'confirm your password';
                echo 'confirm your password';
                
            }else{
                $insert_user = $conn->prepare("INSERT INTO `users`(user_id,name,email,password) VALUES(?,?,?,?)");
                $insert_user->execute([$id,$name,$email,$pass]);
                $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
                $select_user->execute([$email,$pass]);
                $row = $select_user->fetch(PDO::FETCH_ASSOC);
                if ($select_user->rowCount() > 0) {
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['user_name'] = $row['name'];
                    $_SESSION['user_email'] = $row['email'];
                    header('location: home.php');
                }    
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
    <link rel="stylesheet" href="./style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Coffee - Register Now</title>
</head>
<body>
    <div class="main-container">
        <section class="form-container">
            <div class="title">
                <img src="./img/download.png" alt="">
                <h1>Register Now</h1>
                <p>Your Journey to Wellness Starts Here—Register Now!</p>
            </div>
            <form action="" method="post">
                <div class="input-field">
                    <p>Your Name <sub>*</sub></p>
                    <input type="text" name="name" required placeholder="Enter Your Name" maxlength="50">
                </div>

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

                <div class="input-field">
                    <p>Confirm Password <sub>*</sub></p>
                    <input type="password" name="cpass" required placeholder="Enter Your Password" maxlength="50"
                    oninput="this.value = this.value.replace(/\s/g, '')">
                </div>
                <input type="submit" name="submit" value="register now" class="btn">
                <p>alredy have an account? <a href="login.php">Login Now</a></p>
            </form>
        </section>
    </div>
    <?php include './components/alert.php'; ?>
</body>
</html>