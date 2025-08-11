<?php
include('conn.php');

$name   = $_POST['name'];
$gender = $_POST['gender'];
$language = implode(',', $_POST['language']);
$city   = $_POST['city'];

$photo   = $_FILES['photo'];
$filename = $photo['name'];
$filetmp  = $photo['tmp_name'];
$dis      = 'uploads/'.$filename;
move_uploaded_file($filetmp, $dis);

$query = "INSERT INTO stu2 (`name`, `gender`, `language`, `city`, `photo`) 
          VALUES ('$name', '$gender', '$language', '$city', '$dis')";
$insert = mysqli_query($con, $query);
?>



