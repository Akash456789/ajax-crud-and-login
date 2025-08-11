<?php

$host="localhost";
$name="root";
$pass="";
$db="ajax2";

$con=mysqli_connect($host, $name, $pass, $db);

if(!$con){
    echo "conn";
}
?>
