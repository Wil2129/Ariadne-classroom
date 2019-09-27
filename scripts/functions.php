<?php
// session_start();

//connecting to database
function dbConnect()
{
    $dbname = "hng_classroom";
    $username = "root";
    $password = "";
    try {
        $handle = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);
        $handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $handle;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function register_student($name, $username, $passwordt)
{
    $name = clean_input($name);
    $username = clean_input($username);
	$password = md5($password);
    try {
        $handle = dbConnect();
        $stmt = $handle->prepare("INSERT INTO students (`name`,`username`,`password`) 
                                        VALUES (:name, :uname, :pswd)");
        $stmt->execute(array(':name' => $name, ':uname' => $username, ':pswd' => $password));
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function login_student()
{
    try {
        $handle = dbConnect();
        $stmt = $handle->prepare("SELECT * FROM students");
        $stmt->execute();
        $students = $stmt->fetchAll();
        return $students;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function register_teacher($name, $username, $password, $subject)
{
    $name = clean_input($name);
    $username = clean_input($username);
	$password = md5($password);
    $subject = clean_input($subject);
    try {
        $handle = dbConnect();
        $stmt = $handle->prepare("INSERT INTO teacher (`name`,`username`,`password`,`subject_id`) 
                                        VALUES (:name, :uname, :pswd, :sub)");
        $stmt->execute(array(':name' => $name, ':uname' => $username, ':pswd' => $password, ':sub' => $subject));
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function login_teacher()
{
    try {
        $handle = dbConnect();
        $stmt = $handle->prepare("SELECT * FROM teacher");
        $stmt->execute();
        $teachers = $stmt->fetchAll();
        return $teachers;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


//teacher_id = id of the currently logged in teacher
function create_class($name, $id, $age, $teacher_id)
{
    try {
        $handle = dbConnect();
        $stmt = $handle->prepare("INSERT INTO classes (`name`,`subject_id`, `age`, `teacher_id`) 
                                                    VALUES (:name, :s_id, :age, :t_id)");
        $stmt->execute(array(':name' => $name, ':s_id' => $id, ':age'=>$age,  ':t_id' =>$teacher_id));
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function show_classes($teacher_id)
{
    try {
        $handle = dbConnect();
        $stmt = $handle->prepare("SELECT * FROM classes WHERE `teacher_id` = :id");
        $stmt->execute(array(':id' => $teacher_id));
        $classes = $stmt->fetchAll();
        return $classes;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function show_all_classes()
{
    try {
        $handle = dbConnect();
        $stmt = $handle->prepare("SELECT * FROM classes");
        $stmt->execute();
        $classes = $stmt->fetchAll();
        return $classes;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function add_item($title, $content, $attachment = 'NULL', $class_id)
{
    try {
        $handle = dbConnect();
        $stmt = $handle->prepare("INSERT INTO items (`title`,`content`,`attachment`,`class_id`) VALUES (:title, :content, :attach, :id)");
        $stmt->execute(array(':title' => $title, ':content' => $content, ':attach' => $attachment, ':id' => $class_id));
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function upload_file($folder)
{
    $file_name = $_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];
    $max_size = 200000;
    if ($file_size <= $max_size) {
        if ($file_type == 'application/pdf') {
            move_uploaded_file($file_loc, $folder . $file_name);
            return true;
        }
    }
}


function show_items($class_id)
{
    try {
        $handle = dbConnect();
        $stmt = $handle->prepare("SELECT * FROM items WHERE `class_id` = :id");
        $stmt->execute(array(':id' => $class_id));
        $items = $stmt->fetchAll();
        return $items;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function show_all_items()
{
    try {
        $handle = dbConnect();
        $stmt = $handle->prepare("SELECT * FROM items");
        $stmt->execute();
        $classes = $stmt->fetchAll();
        return $classes;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

//sanitize user input
function clean_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function logout_teacher()
{
    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session.
    session_destroy();
}

function fetch_subjects()
{
    try {
        $handle = dbConnect();
        $stmt = $handle->prepare("SELECT * FROM subjects");
        $stmt->execute();
        $subjects = $stmt->fetchAll();
        return $subjects;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>