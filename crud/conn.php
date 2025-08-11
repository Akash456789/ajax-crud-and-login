<?php
$host="localhost";
$name="root";
$password="";
$db="ajax2";

$con=mysqli_connect($host, $name, $password, $db);
if($con){
    echo "database connect";
}else{
    echo "not concect";
}
?>