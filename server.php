<?php
require 'db/db.php';

$Username = $_POST["username"];
$Password = $_POST["password"];
$UserRole = $_POST["user_role"];

$insert = "INSERT INTO `user`(`username`, `password`, `user_role`) VALUES ('$Username','$Password','$UserRole')";

if($con->query($insert) === TRUE){
    echo "successful";
}
else{
    echo $con->error;
}
?>
