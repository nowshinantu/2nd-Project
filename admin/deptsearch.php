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
    include('partials/navbar.php');
    session_start();
    ?>

    <div class="container mt-3 p-4">
       <h2>Search</h2>
       <hr style="width: 40%; height: 2px">
        <div class="row">
            <div class="col-5">
                <form action="" class="login-form"  method="post">
                    <h4></h4>
                    <label for="">Department</label>
                    <select name="Dept" class="form-control mb-3" id="">
                        <?php
                    include_once('../db/dbconnect.php');
    $sql = "SELECT * FROM departments";
    $res = getDataFromDB($sql);
                    foreach($res as $row){
                        ?>
                        <option value="<?php echo $row["Dept_ID"] ?>"><?php echo $row["Dept_ID"].' '.$row["Departtment"] ?></option>
                        <?php
                    }
                    ?>
                    </select>
                    <label for="">Position</label>
                    <select name="Pos" class="form-control mb-3" id="">
                        <?php
                    include_once('../db/dbconnect.php');
    $sql = "SELECT * FROM positions";
    $res = getDataFromDB($sql);
                    foreach($res as $row){
                        ?>
                        <option value="<?php echo $row["PositionID"] ?>"><?php echo $row["PositionID"].' '.$row["Position"] ?></option>
                        <?php
                    }
                    ?>
                    </select>

                    <button type="submit" class="btn btn-block btn-success"  name="submit">Submit</button>
                </form>
            </div>
            <div class="col-6">
                <?php
                if(isset($_POST['submit'])){
                    ?>
                    <table class="table table-striped">
                        <tr>
                            <th>Emp ID</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                        <?php
                        include_once('../db/dbconnect.php');
    $sql = "SELECT * FROM employees WHERE Dept_ID = '".$_POST['Dept']."' AND Pos_ID = '".$_POST['Pos']."'";
    $res = getDataFromDB($sql);
                    foreach($res as $row){
                        ?>
                        <tr>
                            <td><?php echo $row["Emp_ID"]; ?></td>
                            <td><?php echo $row["FName"].' '.$row['LName']; ?></td>
                            <td><?php echo $row["Email"]; ?></td>
                        </tr>
                        <?php

                    }
                        ?>
                    </table>

                    <?php
                }
                ?>
            </div>
        </div>
    </div>

  <script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js'></script><script  src="js/script.js"></script>

</body>
</html>
