<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Payroll</title>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"><link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css'><link rel="stylesheet" href="css/style.css">
    <style>
        *{
            font-family: Times New Roman;
        }
    </style>
</head>
<body>
<?php
    function workday($id){

include_once('../db/dbconnect.php');
        $sql = "SELECT * FROM payroll WHERE PayrollID = '".$id."'";
        global $con;
        $res = getDataFromDB($sql);
        foreach($res as $row){
            $workDay = $row["WorkDay"];
        }
        return $workDay;
    }

    function deduc($id){
        include_once('../db/dbconnect.php');
        $sql = "SELECT SUM(Amount) as ded FROM deductionamount WHERE Emp_ID = '".$id."'";
        global $con;
        $res = getDataFromDB($sql);
        foreach($res as $row){
            $ded = $row["ded"];
        }
        return $ded;
    }

       function allw($id){
        include_once('../db/dbconnect.php');
        $sql = "SELECT * FROM gradewiseallowance WHERE GradeName = (SELECT Grade FROM employees WHERE Emp_ID = '".$id."'); ";
        global $con;
        $res = getDataFromDB($sql);

        return $res;
    }

    function allowance($grade){
        include_once('../db/dbconnect.php');
        $sql = "SELECT * FROM gradewiseallowance WHERE GradeName = '".$grade."' AND ChargeName = 'Allowance'";
//        echo $sql;
        global $con;
        $res = getDataFromDB($sql);
        
//        var_dump (count($res));
        if(count($res) != 0){
        foreach($res as $row){
            $ded = $row["Amount"];
        }
            
        return $ded;
        }
        else{
            return 0;
        }
    }

    function houserent($grade){
        include_once('../db/dbconnect.php');
        $sql = "SELECT * FROM gradewiseallowance WHERE GradeName = '".$grade."' AND ChargeName = 'House Rent'";
        global $con;
        $res = getDataFromDB($sql);
       
        if(count($res) != 0){
        foreach($res as $row){
            $ded = $row["Amount"];
        }
        return $ded;
    }
        else{
            return 0;
        }
    }
        
        

    function medical($grade){
        include_once('../db/dbconnect.php');
        $sql = "SELECT * FROM gradewiseallowance WHERE GradeName = '".$grade."' AND ChargeName = 'Medical'";
        global $con;
        $res = getDataFromDB($sql);
        if(count($res) != 0){
        foreach($res as $row){
            $ded = $row["Amount"];
        }
        return $ded;
    } else{
            return 0;
        }
    }

    function convenience($grade){
        include_once('../db/dbconnect.php');
        $sql = "SELECT * FROM gradewiseallowance WHERE GradeName = '".$grade."' AND ChargeName = 'Dearness'";
        global $con;
        $res = getDataFromDB($sql);
        
        if(count($res) != 0){
        foreach($res as $row){
            $ded = $row["Amount"];
        }
        return $ded;
    } else{
            return 0;
        }
    }

    function bonus($grade){
        include_once('../db/dbconnect.php');
        $sql = "SELECT * FROM gradewiseallowance WHERE GradeName = '".$grade."' AND ChargeName = 'Bonus'";
        global $con;
        $res = getDataFromDB($sql);
        
        if(count($res) != 0){
        foreach($res as $row){
            $ded = $row["Amount"];
        }
        return $ded;
    } else{
            return 0;
        }
    }

    function others($grade){
        include_once('../db/dbconnect.php');
        $sql = "SELECT * FROM gradewiseallowance WHERE GradeName = '".$grade."' AND ChargeName = 'Others'";
        global $con;
        $res = getDataFromDB($sql);
        
        if(count($res) != 0){
        foreach($res as $row){
            $ded = $row["Amount"];
        }
        return $ded;
    } else{
            return 0;
        }
    }
    include('partials/navbar.php');
    session_start();
    ?>




                   <?php
include_once('../db/dbconnect.php');
$sql = "SELECT * FROM payroll WHERE PayrollID = '".$_GET['id']."'";
$res = getDataFromDB($sql);
foreach($res as $row){
    $start = $row['Start'];
    $end = $row['End'];
}

$secsql = "SELECT *,SUM(LateCount) as TotalLate,SUM(Present) as TotalPresent FROM attendance INNER JOIN employees ON employees.Emp_ID = attendance.EmployeeID WHERE Date >= $start AND '".$end."' >= Date  GROUP BY EmployeeID";
$result = getDataFromDB($secsql);
foreach($result as $row){
    $workday = workday($_GET['id']);
    $absent = workday($_GET['id'])-$row['TotalPresent'];
    $lateabsent = floor($row['TotalLate']/3);
//    echo $row["Grade"];

    $allowance = allowance($row["Grade"]);
    
    $houserent = houserent($row["Grade"]);
    $medical = medical($row["Grade"]);
    $convenience = convenience($row["Grade"]);
    $bonus = bonus($row["Grade"]);
    $others = others($row["Grade"]);
//    echo $allowance;
    $perdaysalary = $allowance/$workday;
    $latededuction = ceil($perdaysalary*$lateabsent);
    $absentdeduction = ceil($perdaysalary*$absent);
    $totdeduction = $latededuction+$absentdeduction;

    $salary = $allowance-$totdeduction;

    $extdeduc = deduc($row['EmployeeID']);
//    $allowance = allw($row['EmployeeID']);
//    var_dump ($allowance);
    $extraallowance = $houserent + $medical + $convenience + $bonus + $others;
    $netsalary = $salary + $extraallowance - $extdeduc;

    $inssql = "INSERT INTO `calculation`( `PayrollID`, `Emp_ID`, `WorkDay`, `Present`, `Absent`, `LateAbsent`, `SalaryDeduction`, `SalaryToGet`, `DeductionTotal`, `AllowanceTotal`, `NetSalary`) VALUES ('".$_GET['id']."','".$row['EmployeeID']."','".$workday."','".$row['TotalPresent']."','".$absent."','".$lateabsent."','".$totdeduction."','".$salary."','".$extdeduc."','".$allowance."','".$netsalary."')";
    $inssql = "INSERT INTO `calculation`( `PayrollID`, `Emp_ID`, `BasicSalary`, `PerDay`, `WorkDay`, `Present`, `Absent`, `LateAbsent`, `SalaryDeduction`, `SalaryToGet`, `Adjustment`, `AllowanceTotal`, `NetSalary`, `Medical`, `HouseRent`, `Dearness`, `Bonus`, `Others`) VALUES ('".$_GET['id']."','".$row['EmployeeID']."','".$allowance."','".$perdaysalary."','".$workday."','".$row['TotalPresent']."','".$absent."','".$lateabsent."','".$totdeduction."','".$salary."','".$extdeduc."','".$extraallowance."','".$netsalary."','".$medical."','".$houserent."','".$convenience."','".$bonus."','".$others."')";

//    echo $inssql;
//    echo '<br>';
    $upsql = "UPDATE payroll SET Status = 'Calculated' WHERE PayrollID = '".$_GET['id']."'";
    include_once('../db/db.php');
    
//    echo $upsql;
     if($con->query($inssql) ===  TRUE AND $con->query($upsql) ===  TRUE){
    $_SESSION['msg'] = "Added Successfully";
//        echo $_SESSION['msg'];
      }

      else{
          echo $con->Error;
      }
    ?>

    <?php
}
?>


  <script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js'></script><script  src="js/script.js"></script>

</body>
</html>
