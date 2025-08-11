<?php
include('conn.php');

$id = $_POST['id'];
if(mysqli_query($con, "DELETE FROM stu2 WHERE id='$id'")){
    echo "Record deleted successfully.";
} else {
    echo "Error deleting record.";
}
?>
