<?php

$sql="DELETE FROM `employees` WHERE Dept_ID='".$_GET["id"]."'";
include_once("../../db/db.php");

if($con->query($sql) === TRUE){
    echo '<script language="javascript">';
    echo 'alert("Employee Removed Successfully");
    location.href="Officestaff.php"';
    echo '</script>';
}
else{
    echo $con->Error;
}

?>
