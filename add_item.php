<?php 
session_start();
require_once('scripts/functions.php');

if (isset($_POST['create'])) {

	$title = $_POST['title'];
	$content = $_POST['content'];
	$file = $_FILES['file']['name'];
	//this will be defined from the class selected
	$class_id = $_POST['class'];
	$upload_folder = "scripts/uploads/";

	//checking if there's any attachment
    if ($file != NULL) {
        //handling attachments
        if (upload_file($upload_folder)) {
            if (add_item($title, $content, $file, $class_id)) {
                ?>
                <script type="text/javascript">
                    alert('Item successfully added.');
                    window.location = 'teacher_dashboard.php';
                </script><?php
            } else { ?> <script type="text/javascript">alert('Item Not Added!');</script><?php }
        } else {
            ?><script type="text/javascript">alert('File size cannot be more than 200kb and MUST be in PDF format.');</script><?php
        }
    } else {

    	if (add_item($title, $content, $file, $class_id)) {
                ?>
                <script type="text/javascript">
                    alert('Item successfully added.');
                    window.location = 'teacher_dashboard.php';
                </script><?php
        } else { ?> <script type="text/javascript">alert('Item Not Added!');</script><?php }
    }
}


?>
<html>  
  <head>    
      <title>  Add Item </title>
      <link rel="stylesheet" href="styleIndex.css">
  </head>


<body>
     <h2> ADD ITEM</h2>
     <form method="POST" enctype="multipart/form-data" name="item" action="<?= $_SERVER["PHP_SELF"];?>">
     	<div style="margin: 10px;">
     		<label for="userInput">Enter item title:</label>
     		<input id="userInput" type="text" placeholder="New item" name="title">
     	</div>
     	<div style="margin: 10px;">
     		<label for="userInput2" >Select class to add Item to:</label>
     		<select name="class" id="userInput2">
     		<option value="">..select class..</option>
     		<?php 
     		$current_teacher_classes = show_classes($_SESSION['id']);
     		foreach ($current_teacher_classes as $class) {?>
     			<option value="<?= $class['id']; ?>"><?= $class['name']; ?></option><?php
     		}
     		?>
     	</select>
     	</div>
     	<div>
     		<label>Item Content:</label>
     		<textarea name="content"></textarea>
     	</div>
     	<div style="margin: 10px;">
     		<label>Add Attachment (If applicable:</label>
			<input type="file" name="file" placeholder="Upload PDF here"><br>
			<small>Note: File must be PDF and not more than 200MB</small><br>
     	</div>
     	
           <button class="btn-submit" type="submit" name="create">Add</button>
     </form>
     <div>
     	<a href="teacher_dashboard.php" style="background-color: #f44336; color: white">Back</a>
     </div>
       <script src="realIndex.js" >  </script>
</body>




</html>