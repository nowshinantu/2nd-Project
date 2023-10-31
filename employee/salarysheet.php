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
    include('partials/nav.php');
    session_start();
    ?>

    <div class="container mt-3 p-4">
       <h2>Salary Info
       <span class="float-right">

       </span>
       </h2>


<!-- The Modal -->
       <hr style="width: 100%; height: 2px">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered table-sm table-striped">
                    <tr>
                        <th>Payroll ID</th>
                        <th>Employee ID </th>
                        <th>Work Day</th>
                        <th>Present</th>
                        <th>Absent</th>
                        <th>Absent For Late</th>
                        <th>Absent Deduction</th>
                        <th>Gross Salary</th>
                        <!-- <th>Adjustment</th> -->
                        <th>Allowance</th>
                        <th>Total</th>
                    </tr>
                    <?php
                    include_once('../db/dbconnect.php');
    $sql = "SELECT * FROM calculation WHERE Emp_ID = '".$_SESSION["username"]."' AND PayrollID = (SELECT PayrollID FROM payroll WHERE Status = 'Calculated'  ORDER BY SerialNo DESC  Limit 1 )";
    $res = getDataFromDB($sql);
                    foreach($res as $row){
                        ?>
                        <tr>
                            <td><?php echo $row['PayrollID'] ?></td>
                            <td><?php echo $row['Emp_ID'] ?></td>
                            <td><?php echo $row['WorkDay'] ?></td>
                            <td><?php echo $row['Present'] ?></td>
                            <td><?php echo $row['Absent'] ?></td>
                            <td><?php echo $row['LateAbsent'] ?></td>
                            <td><?php echo $row['SalaryDeduction'] ?></td>
                            <td><?php echo $row['SalaryToGet'] ?></td>
                            <td><?php echo $row['AllowanceTotal'] ?></td>
                            <td><?php echo $row['NetSalary'] ?></td>

                        </tr>



                         <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

  <script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js'></script><script  src="js/script.js"></script>

</body>
</html>
