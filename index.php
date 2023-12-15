<?php
session_start();
include("config.php");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or handle the situation appropriately
    header("Location: login.php");
    exit();
}

// Assuming you have stored the user ID in the session during login
$user_id = $_SESSION['user_id'];

// Retrieve user's first name
$user_query = "SELECT fname FROM journal WHERE id = $user_id";
$user_result = mysqli_query($conn, $user_query);
$user_data = mysqli_fetch_assoc($user_result);
$first_name = $user_data['fname'];

// Retrieve notes for the logged-in user
$notes_query = "SELECT * FROM notes WHERE user_id = $user_id";
$notes_result = mysqli_query($conn, $notes_query);

// Retrieve checklists for the logged-in user
$checklists_query = "SELECT * FROM checklists WHERE user_id = $user_id";
$checklists_result = mysqli_query($conn, $checklists_query);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0" >
        <title>2-2</title> 

        <!-- ---------- CSS FILE LINK ---------- -->
        <link rel="stylesheet" type="text/css" href="assets/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    </head>

    <body style="background: url(whitebg.jpg);background-size: 100% 100%;" body text="#461959">
        <!---------------------Header--------------------->
        <header class="header">
        <img src="" id="complogo1">
		<h1 class="logo"><a href="#"><?php echo $first_name; ?>'s Journal</a></h1>
          <ul class="main-nav">
            <li><a href="#Home">Home</a></li>
            <li><a class="logout" href="login.php">Log Out</a></li>
          </ul>
	    </header>
        <!--------------------- H o m e --------------------->
        <div class="wrapper">
            <main>
                <section class="module parallax parallax-1" id="Home">
                   
        <h1>ONEIRIC DIARY</h1>
        
           
	    <div class="button-container">
	        <a class="button" href="notes.php">Notes</a>
	        <a class="button" href="checklists.php">Checklists</a>
	    </div>
        <footer class="footer">    
        <p>Developed by Group 6 - PHP Group </p>
        </footer>
                </section>
             
            </main>
        </div>    
    </body>
</html>
<?php
// Close the database connection
mysqli_close($conn);
?>
