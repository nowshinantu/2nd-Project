<?php
$Username = $_POST['username'];
$Password = md5($_POST['password']);

$usersql = "SELECT * FROM employees WHERE Emp_ID = '".$Username."'";
include_once 'db/dbconnect.php';
$som = getDataFromDB($usersql);
$count = count($som);
if($count != 0){

    session_start();
    foreach($som as $row){

        if($row['Emp_ID'] == $Username and $row["Password"] == $Password){

            if($row['UserRole'] == "Admin"){
                $_SESSION["user_role"] = 'Admin';
                $_SESSION["username"] = $row["Emp_ID"];
                $_SESSION["flag"] = 'running';
                header("Location: admin/dashboard.php");
                }
                elseif($row['UserRole'] != "Admin"){
                    $_SESSION["user_role"] = $row["UserRole"];
                    $_SESSION["username"] = $row["Emp_ID"];
                    $_SESSION["flag"] = 'running';
                    header("Location: employee/dashboard.php");
                }
            else{
                echo 'non-user';
            }
        }
        else{
            echo "Invalid Email & Password";
        }
    }

}
else{
    echo "No User Found";
}
?>
