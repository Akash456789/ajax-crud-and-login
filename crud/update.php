<?php
include('conn.php');

$id       = $_POST['id'];
$name     = $_POST['name'];
$gender   = $_POST['gender'];
$language = implode(',', $_POST['language']);
$city     = $_POST['city'];

if(!empty($_FILES['photo']['name'])){
    $filename = $_FILES['photo']['name'];
    $filetmp  = $_FILES['photo']['tmp_name'];
    $photo_path = 'uploads/'.$filename;
    move_uploaded_file($filetmp, $photo_path);

    $query = "UPDATE stu2 SET name='$name', gender='$gender', language='$language', city='$city', photo='$photo_path' WHERE id='$id'";
} else {
    $query = "UPDATE stu2 SET name='$name', gender='$gender', language='$language', city='$city' WHERE id='$id'";
}

if(mysqli_query($con, $query)){
    echo "Record updated successfully!";
} else {
    echo "Error: " . mysqli_error($con);
}
