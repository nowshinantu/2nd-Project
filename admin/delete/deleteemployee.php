<?php
$sql="DELETE FROM `employees` WHERE Email='".$_GET["id"]."'";
include_once("../../db/db.php");

if($con->query($sql) === TRUE){
    echo '<script language="javascript">';
    echo 'alert("Employee Removed Successfully");
    location.href="../employee.php"';
    echo '</script>';
}
else{
    echo $con->Error;
}

?>
