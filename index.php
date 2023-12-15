<?php
session_start();
include("config.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $Email = $_POST['email'];
    $Password = $_POST['password'];

    if (!empty($Email) && !empty($Password)) {
        $query = "SELECT * FROM journal WHERE email = '$Email' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);

            if (password_verify($Password, $user_data['password'])) {
                // Password verification using password_hash()
                $_SESSION['user_id'] = $user_data['id']; // Assuming 'id' is the user ID column
                header("location: home.php");
                die;
            }
        }
    }
    echo "<script type='text/javascript'> alert('Wrong Email or Password. Please try again.')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0" >
        <title>2-2</title> 

        <!-- ---------- CSS FILE LINK ---------- -->
        <link rel="stylesheet" type="text/css" href="assets\style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    </head>

    <body style="background: url('whitebg.jpg'); background-size: 100% 100%; color: #461959;">
        <!---------------------Header--------------------->
        <header class="header">
        <img src="" id="complogo1">
		<h1 class="logo"><a href="#">ONEiric Diary</a></h1>
          <ul class="main-nav">
            <li><a href="#Home">Home</a></li>
            <li><a href="#Register">Login</a></li>
          </ul>
	    </header>
        <!--------------------- H o m e --------------------->
        <div class="wrapper">
            <main>
                <section class="module parallax parallax-1" id="Home">
                    <h1>ONEiric Diary</h1>
                </section>
        <!-- -------- REGISTER FORM -------- -->
        <section class="module parallax parallax-2" id="Register">
            <div class="form-container">
            <form action="" method="post"> 
            <div class="login">
              <h3>LOGIN</h3>
              <form method="POST">
                <input type="email" name="email" required placeholder="enter your email">
                <input type="password" name="password" required placeholder="enter your password">
                <input type="submit" name="submit" value="LOGIN" class="form-btn">
              </form>
        <p>By clicking the Login button, you agree to our<br>
        <a href="">Terms and Condition</a> and <a href="a">Policy Privacy</a>
        </p>
        <p>Don't have an account yet? <a href="signup.php">Sign-up Here</a></p>
    </div>
        </section>        
            </main>
        </div>    
    </body>
</html>