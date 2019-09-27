<?php
session_start();
require_once('scripts/functions.php');

$message = ''; //for storing error messages
if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $subject_id = $_POST['subject'];
    $age = $_POST['age'];

    //checking for emptiness
    if (empty($name) || empty($subject_id) || empty($age)) {
        $message = '<div style="color: red;">**All fields are required**</div>';
    } else {
        $create = create_class($name, $subject_id, $age, $_SESSION['id']);
        if ($create) {
            $message = '<div style="color: green;">**Registration successful**</div>';
        }
        else {
            $message = '<div style="color: red;">**Class creation NOT successful**</div>';
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ariadne :: Create Class</title>
    <link rel="stylesheet" type="text/css" href="createclass.css"/>
</head>
<body>
<div class="container">
    <form id="createClassForm" action="" method="post">
        <h1>Hi, <?= $_SESSION['name'] ?>, Create a class for your students</h1>

        <?php echo $message; ?>
        <p id="detailsHeader">Enter the details about your class, courses and grades</p>

        <input type="text" name="name" placeholder="Enter your class name" required id="enterClassName"><br>
        <div class="coursegroup">
            <select name="subject" class="subjects" required>
                <option value="">--Please choose an option--</option>
                <?php foreach (fetch_subjects() as $subject) { ?>
                    <option value="<?= $subject['id']; ?>"><?= $subject['name']; ?></option>
                <?php } ?>
            </select>
            <br>

            <select name="age" class="age" required>
                <option value="">--Please choose your age range--</option>
                <option value="7-15">7 - 15</option>
                <option value="16-25">16 - 25</option>
                <option value="26-35">26 - 35</option>
                <option value="36-45">36 - 45</option>
                <option value="45-above">45 above</option>
            </select>
            <br>
        </div>
        <input type="submit"  name="create" value="Create Class">
    </form>
</div>
<a href="teacher_dashboard.php" style="background-color: #f44336; color: white">Back</a>
</body>
<script type="text/javascript" src="test.js"></script>
</html>
