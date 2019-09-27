<?php
require_once('scripts/functions.php');

$message = ''; //for storing error messages
//checking for user input for teacher sign up
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];
    $subject = $_POST['subject'];

    //checking for emptiness
    if (empty($name) || empty($username) || empty($password) || empty($confirm) || empty($subject)) {
        $message = '<div style="color: red;">**All fields are required**</div>';
    } else {
        if ($password === $confirm) {
            $check_registered = FALSE;
            foreach (login_teacher() as $teacher) {
                if ($teacher['username'] == $username) {
                    $check_registered = TRUE;
                }
            }
            if (!$check_registered) {
                $register = register_teacher($name, $username, $password, $subject);
                if ($register) {
                    $message = '<div style="color: green;">**Registration successful**
                       <a href="teacher_login.php">Click Here </a> to login.</div>';
                }
            } else {
                $message = '<div style="color: red;">**Username already exists!**</div>';
            }
        } else {
            $message = '<div style="color: red;">**Password and Repeat password does not match.**</div>';
        }
    }
}


?>

<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <title>Sign Up form</title>
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
            <a href="teacher_login.php">Login</a>
            <a href="#">Contact Us</a>
            <a href="#">FAQ</a>
            <a href="#">Courses</a>
            <a href="about-us.html">How it works</a>
            <a href="create_class.php">Create Class</a>
            <a href="#">Home</a>
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

<form action="signup.php" method="post">
    <div class="imgcontainer">
        <img src="https://res.cloudinary.com/enema/image/upload/v1569433441/Ariadne_Class_pnlixb.png" alt="Avatar"
             class="avatar" height="100" width="50">
    </div>

    <div class="container">
        <div><?php echo $message; ?></div>
        <label for="FullName"><b>Full name</b></label>
        <input type="text" placeholder="Enter full name" name="name">

        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username">

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password">
        <label for="psw"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat password" name="confirm_password">
        <div class="coursegroup">

            <select name="subject" class="subjects">
                <option value="">--Please choose a class--</option>
                <?php foreach (fetch_subjects() as $subject) { ?>
                    <option value="<?= $subject['id']; ?>"><?= $subject['name']; ?></option>
                <?php } ?>
            </select>
            <input type="submit" name="register" value="Sign Up">
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
