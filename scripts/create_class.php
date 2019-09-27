<?php
session_start();

if (isset($_SESSION['username'])) { ?>
    <script type="text/javascript">
        window.location = 'teacher_dashboard.php';
    </script> <?php
} else {
    ?>
    <script type="text/javascript">
        window.location = '../teacher_login.php';
    </script> <?php
}



?>