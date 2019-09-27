<?php
session_start();
require_once('scripts/functions.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ariadne :: Teacher Dashboard</title>
    <link rel="stylesheet" href="homepage.css">
</head>
<body>
<div class="header">
    <div class="logo">
        <a href="#"><img
                src="https://res.cloudinary.com/enema/image/upload/v1569433441/Ariadne_Class_pnlixb.png"
                style="width: 110px;" alt="logo">
        </a>
    </div>
    <div class="topnav" id="myTopnav">
        <a href="javascript:void(0);" class="icon" onclick="myFunction()"><img src="https://res.cloudinary.com/siyfa/image/upload/v1568922461/ovqrbsa6t7nhghflejve.png" style="width: 30px;">
        </a>
        <a href="teacher_logout.php">Logout</a>
        <a href="add_item.php">Add Items to a Class</a>
        <a href="create_class.php">Create Class</a>
        <h1 style="color: darkgreen">Hi <?= $_SESSION['name']; ?>, Welcome to your dashboard.</h1>
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
<div style="color: black;">
    <p>Classes created by <?= $_SESSION['username']; ?>:</p>

    <?php
    $current_teacher_classes = show_classes($_SESSION['id']);

    if ($current_teacher_classes) {
        echo '<ul>';
        foreach ($current_teacher_classes as $title => $class) {
            $_SESSION['current_class'] = $class['id'];
            echo '<li><p>'.strtoupper($class["name"]).' CLASS</p></li>'; //showing items under each class

            $current_class_items = show_items($_SESSION['current_class']);
            $item_message = '';
            if (!empty($current_class_items)) {
                $item_message = '<i>Items under '.$class['name'].' class:</i>';
            }
            echo $item_message;
            foreach ($current_class_items as $key => $item) {
                //checking for attachment
                $attach = '(No attachment added)';
                if ($item['attachment'] != NULL) {

                    $attach = '<a href="scripts/uploads/'.$item['attachment'].'" download>Download attached file</a>';
                }
                $item_details = '<p> $item["title"] </p><ul>';
                echo '<p><b>'.$item['id'].'. <i>Title: '.$item["title"].'</i></b></p><small>Content: '.$item["content"].'<p>'.$attach.'</p></small>';
            }
		// echo '</ul><br><a href="item.php">Add Item to class</a>';

        }
        echo '</ul>';
    }
    ?>
</div>
<div>
    <div>
        <footer>
            <p>Copyright © 2019 All rights reserved | Team Ariadne</p>
        </footer>
    </div>
</body>
</html>