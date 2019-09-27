<?php
session_start();
require_once('scripts/functions.php');

$message = ''; //for storing error messages
//signing in students
if(isset($_POST['login'])){
    $username = '';
    $password = '';
    // check if all form data are submited, else output error message
    if(isset($_POST['username']) && isset($_POST['password'])) {
        // if form fields are empty, outputs message, else, gets their data
        if(empty($_POST['username']) || empty($_POST['password'])) {
            //error handling
            $message = '<div style="color: red;">**Please, enter username and password**</div>';
        }
        else {
            $username = $_POST["username"];
            $password = md5($_POST["password"]);
            $students = login_student();

            foreach ($students as $student) {
                if (($student['username'] == $username) && ($student['password'] == $password)) {
                    //setting session variables
                    $_SESSION['id'] = $student['id'];
                    $_SESSION['username'] = $student['username'];
                    $_SESSION['name'] = $student['name'];

                    //redirecting to student dashboard.
                    ?>
                    <script type="text/javascript"> window.location = 'student_dashboard.php'; </script> <?php
                } else {
                    $message =  '<div style="color: red;">**Invalid credentials. Please, try again.**</div>';
                }
            }
        }
    } else { $message = '<div style="color: red;">**Please, enter username and password**</div>'; }
}

?>

<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <title>Ariadne class :: student Login</title>
    <link rel="stylesheet" type="text/css" href="signup.css">
</head>
<header>
    <div class="header">
        <div class="logo">
            <a href="index.html"><img
                    src="https://res.cloudinary.com/enema/image/upload/v1569433441/Ariadne_Class_pnlixb.png"
                    style="width: 110px;" alt="logo">
            </a>
        </div>
        <div class="topnav" id="myTopnav">
            <a href="javascript:void(0);" class="icon" onclick="myFunction()"><img
                    src="https://res.cloudinary.com/siyfa/image/upload/v1568922461/ovqrbsa6t7nhghflejve.png"
                    style="width: 30px;">
            </a>
            <a href="student_login.php">Login</a>
            <a href="#">Contact Us</a>
            <a href="#">FAQ</a>
            <a href="#">Courses</a>
            <a href="#">How it works</a>
            <a href="scripts/create_class.php">Create Class</a>
            <a href="index.html">Home</a>
        </div>
    </div>
    <script>
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }
    </script>
</header>
<body>
<div>
    <h2>Welcome to Ariadne Class, <br>enrol today and enjoy the definition<br> of online education.</h2>
</div>

<form action="student_login.php" method="post">
    <div class="imgcontainer">
        <img src="https://res.cloudinary.com/enema/image/upload/v1569433441/Ariadne_Class_pnlixb.png" alt="Avatar"
             class="avatar" height="100" width="50">
    </div>

    <div class="container">
        <div><?php echo $message; ?></div>
        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username">
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password">

        <input type="submit" name="login" value="Login">
            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
        </div>

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" class="cancelbtn">Cancel</button>
            <span class="psw">Forgot <a href="#">password?</a></span>
        </div>
    </div>
</form>
<section>
    <footer>
        <img src="https://res.cloudinary.com/enema/image/upload/v1569508194/screencapture-file-C-Users-pc-Desktop-TEAM-ARIADNE-HOMEPAGE-homepage-html-2019-09-25-21_51_33_vqmtxf.png"
             width="100%">
    </footer>
</section>
</body>
</html>
