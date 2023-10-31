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
       <h2>Employee List
       <span class="float-right">
       <button  type="button" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-outline-primary">Add New</button>
        <button  type="button" data-toggle="modal" data-target="#absentModal" class="btn btn-sm btn-outline-danger">Add New Absence</button>
       </span>
       </h2>


<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">Add Attendance</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
         <form action="" class="login-form"  method="post">
                    <label for="">Date</label>
                    <input type="date" class="form-control mb-3" name="Date">


                    <label for="">Employee</label>
                    <select name="Emp_ID" class="form-control mb-3" id="">
                        <option value="">Select an employee</option>
                         <?php
                    include_once('../db/dbconnect.php');
    $sql = "SELECT * FROM employees";
    $res = getDataFromDB($sql);
                    foreach($res as $row){
                        ?>
                        <option value="<?php echo $row['Emp_ID'] ?>"><?php echo $row['Emp_ID'].' - '.$row['FName'].' '.$row['LName'] ?></option>

                        <?php
                    }
                    ?>
                    </select>

                    <label for="">In Time</label>

                    <input type="time" class="form-control mb-3" name="InTime">

                    <button type="submit" class="btn btn-block btn-success"  name="submit">Submit</button>
                </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<div class="modal" id="absentModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">Add Leave</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
         <form action="" class="login-form"  method="post">
                    <label for="">Date</label>
                    <input type="date" class="form-control mb-3" name="Date">


                    <label for="">Employee</label>
                    <select name="Emp_ID" class="form-control mb-3" id="">
                        <option value="">Select an employee</option>
                         <?php
                    include_once('../db/dbconnect.php');
    $sql = "SELECT * FROM employees";
    $res = getDataFromDB($sql);
                    foreach($res as $row){
                        ?>
                        <option value="<?php echo $row['Emp_ID'] ?>"><?php echo $row['Emp_ID'].' - '.$row['FName'].' '.$row['LName'] ?></option>

                        <?php
                    }
                    ?>
                    </select>


                    <button type="submit" class="btn btn-block btn-success"  name="absentsubmit">Absent</button>
                </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
       <hr style="width: 100%; height: 2px">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Serial No</th>
                        <th>Employee </th>
                        <th>In Time</th>
                        <th>Lunch Out</th>
                        <th>Second In</th>
                        <th>Out Time</th>
                        <th>Total Hours</th>
                        <th>Short </th>
                        <th>Late</th>
                        <th>Present</th>
                        <th>LateCount</th>
                    </tr>
                    <?php
                    include_once('../db/dbconnect.php');
    $sql = "SELECT *,attendance.SerialNo as SNo FROM attendance inner join employees on employees.Emp_ID = attendance.EmployeeID";
    $res = getDataFromDB($sql);
                    foreach($res as $row){
                        ?>
                        <tr>
                            <td><?php echo $row['SNo'] ?></td>
                            <td><?php echo $row['EmployeeID'].' - '.$row['FName'].' '.$row['LName'] ?></td>
                            <td><?php echo $row['InTime'] ?></td>
                            <td><?php
                            if( $row['LunchOut'] == ""){
                            ?>
                            <button class="btn btn-outline-warning btn-sm"  data-toggle="modal" data-target="#lunchModal" >Add </button>

<div class="modal" id="lunchModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">Lunch Out Time</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
         <form action="" class="login-form"  method="post">

                    <label for="">Serial No</label>
                    <input type="text" value="<?php echo $row['SNo']  ?>" name="SerialNo" readonly class="form-control mb-3">

                    <label for="">Lunch Out Time</label>

                    <input type="time" class="form-control mb-3" name="LunchOut">

                    <button type="submit" class="btn btn-block btn-success"  name="lunchsubmit">Submit</button>
                </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

                            <?php
                            }
                            else{
                                echo $row['LunchOut'] ;
                            } ?>
                            </td>
                            <td><?php
                        if($row['LunchOut']!= ""){
                            if($row['SecondIn'] == ""){
                                ?>
                            <button class="btn btn-outline-info btn-sm"  data-toggle="modal" data-target="#secondModal" >Add </button>

<div class="modal" id="secondModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">Second In Time</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
         <form action="" class="login-form"  method="post">

                    <label for="">Serial No</label>
                    <input type="text" value="<?php echo  $row['SNo']  ?>" name="SerialNo" readonly class="form-control mb-3">

                    <label for="">Second In Time</label>

                    <input type="time" class="form-control mb-3" name="SecondIn">

                    <button type="submit" class="btn btn-block btn-success"  name="secondsubmit">Submit</button>
                </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

                            <?php
                            }
                            else{
                                echo $row['SecondIn'];
                            }
                        }

                                ?>
                            </td>
                            <td><?php
                        if($row['SecondIn']!= ""){
                            if($row['OutTime'] == ""){
                                ?>
                            <button class="btn btn-outline-danger btn-sm"  data-toggle="modal" data-target="#outModal" >Add </button>

<div class="modal" id="outModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">Out Time</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
         <form action="" class="login-form"  method="post">

                    <label for="">Serial No</label>
                    <input type="text" value="<?php echo  $row['SNo']  ?>" name="SerialNo" readonly class="form-control mb-3">

                    <label for="">Out Time</label>

                    <input type="time" class="form-control mb-3" name="OutTime">

                    <button type="submit" class="btn btn-block btn-success"  name="outsubmit">Submit</button>
                </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

                            <?php
                            }
                            else{
                                echo $row['OutTime'];
                            }
                        }

                                ?>
                            </td>
                            <td><?php echo $row['TotalHours'] ?></td>
                            <td><?php echo $row['Short'] ?></td>

                            <td><?php echo $row['Late'] ?></td>
                            <td><?php echo $row['Present'] ?></td>
                            <td><?php echo $row['LateCount'] ?></td>

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

<?php
if(isset($_POST ['submit']))
{
    $checkTime = strtotime('09:00:00');
    $loginTime = strtotime($_POST['InTime']);
    $diff =  $loginTime - $checkTime ;
    $difftime = $diff/60;
//    echo $diff;
//    echo $diff/60;
    if(abs($diff/60) > 30){
        $late = 1;
    }
    else{
        $late = 0;
    }

    include_once('../db/db.php');
    $insert = "INSERT INTO `attendance`( `EmployeeID`, `Date`, `InTime`, `Late`,`LateCount`) VALUES ('".$_POST['Emp_ID']."','".$_POST['Date']."','".$_POST['InTime']."','".$difftime."', '".$late."')";


    if($con->query($insert) ===  TRUE ){
    $_SESSION['msg'] = "Added Successfully";
//        echo $_SESSION['msg'];
      }

      else{
          echo $con->Error;
      }



//   $sql="INSERT INTO tution (class,subj,days,salary,Location)
//   values('$Class','$Subject','$Day','$Salary','$Address');";


//    if($res==TRUE AND $res2==TRUE)
//
//    {
//      $_SESSION['added']= '<h5 class="text-success text-center">Tution Added Successfully</h4>';
//      header('location:'.url.'admin/tution_available_admin.php');
//      exit;
//    }
//
//    else{
//      $_SESSION['added']= '<h4 class="text-danger text-center">Failed Try again</h4>';
//      header('location:'.url.'admin/tution_available_admin.php');
//      exit;
//    }
}

elseif(isset($_POST['lunchsubmit'])){
    $serial = $_POST['SerialNo'];

    include_once('../db/db.php');
    $sql = "UPDATE attendance SET LunchOut = '".$_POST['LunchOut']."' WHERE
    SerialNo = $serial";
    if($con->query($sql) ===  TRUE ){
    $_SESSION['msg'] = "Added Successfully";
//        echo $_SESSION['msg'];
      }

      else{
          echo $con->Error;
      }
}

elseif(isset($_POST['secondsubmit'])){
    $serial = $_POST['SerialNo'];

    include_once('../db/db.php');
    $sql = "UPDATE attendance SET SecondIn = '".$_POST['SecondIn']."' WHERE
    SerialNo = $serial";
    if($con->query($sql) ===  TRUE ){
    $_SESSION['msg'] = "Added Successfully";
//        echo $_SESSION['msg'];
      }

      else{
          echo $con->Error;
      }
}

elseif(isset($_POST['outsubmit'])){
    $serial = $_POST['SerialNo'];

    include_once('../db/dbconnect.php');
    $fetch = "SELECT * FROM attendance WHERE SerialNo = '".$serial."'";
    $res = getDataFromDB($fetch);
    foreach($res as $row){
        $intime = $row['InTime'];
        $lunchtime = $row['LunchOut'];
        $secondin = $row['SecondIn'];
    }

     $mintime = strtotime($intime);
    $mouttime = strtotime($lunchtime);
    $sintime = strtotime($secondin);
    $outime = strtotime($_POST['OutTime']);
    $mdiff =  $mouttime - $mintime ;
    $sdiff =  $outime  - $sintime ;
    $mdifftime = $mdiff/60;
    $sdifftime = $sdiff/60;
//    echo $mdiff;
//    echo '<br>';
//    echo $mdifftime;
//
//    echo '<br>';
//    echo $sdiff;
//    echo '<br>';
    $workhour =  ($sdifftime + $mdifftime);
    $short = 480 - ($sdifftime + $mdifftime);
//    echo $diff;
//    echo $diff/60;
//    if(abs($diff/60) > 30){
//        $late = 1;
//    }
//    else{
//        $late = 0;
//    }



    include_once('../db/db.php');
    $sql = "UPDATE attendance SET OutTime = '".$_POST['OutTime']."', TotalHours = '".$workhour."', Short = '".$short."' WHERE
    SerialNo = $serial";
    if($con->query($sql) ===  TRUE ){
    $_SESSION['msg'] = "Added Successfully";
//        echo $_SESSION['msg'];
      }

      else{
          echo $con->Error;
      }
}
elseif(isset($_POST['absentsubmit'])){

    include_once('../db/db.php');
    $insert = "INSERT INTO `attendance`( `EmployeeID`, `Date`, `InTime`, `LunchOut`, `SecondIn`, `OutTime`, `TotalHours`, `Short`, `Late`, `LateCount`, `Present`) VALUES ('".$_POST['Emp_ID']."','".$_POST['Date']."','00:00:00','00:00:00','00:00:00','00:00:00',0,0,0,0,0)";
    if($con->query($insert) ===  TRUE ){
    $_SESSION['msg'] = "Added Successfully";
//        echo $_SESSION['msg'];
      }

      else{
          echo $con->Error;
      }
}
?>
