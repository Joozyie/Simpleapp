<?php
session_start();
include("config.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $Gender = $_POST['gender'];
    $Number = $_POST['cnum'];
    $Address = $_POST['address'];
    $Email = $_POST['email'];
    $Password = $_POST['password'];

    // Check if the email is not already in use
    $check_email_query = "SELECT * FROM journal WHERE email = '$Email' LIMIT 1";
    $check_email_result = mysqli_query($conn, $check_email_query);

    if ($check_email_result && mysqli_num_rows($check_email_result) > 0) {
        echo "<script type='text/javascript'> alert('Email is already in use.')</script>";
    } else {
        // Hash the password
        $hashed_password = password_hash($Password, PASSWORD_DEFAULT);

        // Use prepared statements to insert user data
        $insert_query = "INSERT INTO journal (fname, lname, gender, cnum, address, email, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insert_query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssssss", $firstname, $lastname, $Gender, $Number, $Address, $Email, $hashed_password);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            echo "<script type='text/javascript'> alert('Successfully Registered')</script>";

            // Redirect to login page after successful registration
            header("location: login.php");
            die;
        } else {
            echo "<script type='text/javascript'> alert('Error in registration.')</script>";
        }
    }
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
            <li><a href="#Register">Sign-Up</a></li>
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
              <div class="signup">
        <h3>Sign Up</h3>
        <h4>Please sign-up first if you don't have an account</h4>
        <form method="POST">
            <input type="text" name="fname" required placeholder="First Name">
            <input type="text" name="lname" required placeholder="Last Name">
            <input type="text" name="gender" required placeholder="Gender">
            <input type="tel" name="cnum" required placeholder="Contact No.">
            <input type="text" name="address" required placeholder="Address">
            <input type="email" name="email" required placeholder="Email">
            <input type="password" name="password" required placeholder="Password">
            <input type="submit" name="" value="Submit" class="form-btn">
        </form>
        <p>By clicking the Sign Up button, you agree to our<br>
        <a href="">Terms and Condition</a> and <a href="a">Policy Privacy</a>
        </p>
        <p>Already have an account? <a href="login.php">Login Here</a></p>
    </div>
    </div>
        </section>        
            </main>
        </div>    
    </body>
</html>