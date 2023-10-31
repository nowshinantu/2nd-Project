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

       <a href="deptsearch.php" class="btn btn-sm btn-outline-primary">View</a>
       <button  type="button" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-outline-primary">Add New</button>

       </span>
       </h2>


<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">Add Employee</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
         <form action="" class="login-form"  method="post">
                    <label for="">First Name</label>
                    <input type="text" class="form-control mb-3" name="FName">

                    <label for="">Last Name</label>
                    <input type="text" class="form-control mb-3" name="LName">

                    <label for="">Email</label>
                    <input type="email" class="form-control mb-3" name="Email">

                    <label for="">Department</label>
                    <select name="Dept_ID" class="form-control mb-3" id="">
                        <option value="">Select a department</option>
                         <?php
                    include_once('../db/dbconnect.php');
    $sql = "SELECT * FROM departments";
    $res = getDataFromDB($sql);
                    foreach($res as $row){
                        ?>
                        <option value="<?php echo $row['Dept_ID'] ?>"><?php echo $row['Dept_ID'].' - '.$row['Departtment'] ?></option>

                        <?php
                    }
                    ?>
                    </select>

                    <label for="">Position</label>
                    <select name="Position_ID" class="form-control mb-3" id="">
                        <option value="">Select a position</option>
                         <?php
                    include_once('../db/dbconnect.php');
    $sql = "SELECT * FROM positions";
    $res = getDataFromDB($sql);
                    foreach($res as $row){
                        ?>
                        <option value="<?php echo $row['PositionID'] ?>"><?php echo $row['PositionID'].' - '.$row['Position'] ?></option>

                        <?php
                    }
                    ?>
                    </select>

                    <label for="">Grade</label>
                    <select name="Grade" class="form-control mb-3" id="">
                        <option value="">Select a grade</option>
                        <?php
                    include_once('../db/dbconnect.php');
    $sql = "SELECT * FROM grades";
    $res = getDataFromDB($sql);
                    foreach($res as $row){
                        ?>
                        <option value="<?php echo $row['GradeName'] ?>"><?php echo $row['GradeName'] ?></option>

                        <?php
                    }
                    ?>
                    </select>
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
       <hr style="width: 100%; height: 2px">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Serial No</th>
                        <th>Department </th>
                        <th>Position</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Grade</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    include_once('../db/dbconnect.php');
    $sql = "SELECT * FROM employees inner join departments on departments.Dept_ID = employees.Dept_ID inner join positions on positions.PositionID = employees.Pos_ID";
    $res = getDataFromDB($sql);
                    foreach($res as $row){
                        ?>
                        <tr>
                            <td><?php echo $row['Emp_ID'] ?></td>
                            <td><?php echo $row['Departtment'] ?></td>
                            <td><?php echo $row['Position'] ?></td>
                            <td><?php echo $row['FName'] ?></td>
                            <td><?php echo $row['LName'] ?></td>
                            <td><?php echo $row['Email'] ?></td>
                            <td><?php echo $row['Grade'] ?></td>
                            <td><!--<a class="btn btn-outline-info btn-sm"  data-toggle="modal" data-target="#alModal">Allowance</a> -->
                            <!-- <a class="btn btn-outline-info btn-sm"  data-toggle="modal" data-target="#dedModal">Deduction</a>  -->
                            <!-- <a href="editdept.php?<?php echo $row['Dept_ID'] ?>" class="btn btn-outline-warning btn-sm">Edit</a> -->
                             <a href="delete/deleteemployee.php?id=<?php echo $row['Email'] ?>" class="btn btn-outline-danger btn-sm">Delete</a></td>
                        </tr>
                        <div class="modal" id="alModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">Add Allowances</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
         <form action="" class="login-form"  method="post">

                    <label for="">Employee ID</label>
                    <input type="text" class="form-control mb-3" name="Emp_ID" value="<?php echo $row['Emp_ID'] ?>">

                    <label for="">Allowance Term</label>
                    <select name="Term" id="" class="form-control mb-3">
                        <option value="">Select a term</option>
                        <?php
                        $sql = "SELECT * FROM allowances";

    include_once('../db/dbconnect.php');
                        $res = getDataFromDB($sql);
                        foreach($res as $row){
                            ?>
                            <option value="<?php echo $row["Allowances"] ?>"><?php echo $row["Allowances"] ?></option>
                            <?php
                        }
                        ?>
                    </select>

                    <label for="">Allowance</label>
                    <input type="number" class="form-control mb-3" name="Allowance">

                    <button type="submit" class="btn btn-block btn-success"  name="alsubmit">Submit</button>
                </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


    <div class="modal" id="dedModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">Add Deduction</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
         <form action="" class="login-form"  method="post">

                    <label for="">Employee ID </label>
                    <select name="Emp_ID" id="" class="form-control mb-3">
                        <option value="">Select the employee</option>
                        <?php
                        $sql = "SELECT * FROM employees";

    include_once('../db/dbconnect.php');
                        $res = getDataFromDB($sql);
                        foreach($res as $row){
                            ?>
                            <option value="<?php echo $row["Emp_ID"] ?>"><?php echo $row["Emp_ID"] ?></option>
                            <?php
                        }
                        ?>
                    </select>

                    <label for="">Deduction Term</label>
                    <select name="Term" id="" class="form-control mb-3">
                        <option value="">Select a term</option>
                        <?php
                        $sql = "SELECT * FROM deductions";

    include_once('../db/dbconnect.php');
                        $res = getDataFromDB($sql);
                        foreach($res as $row){
                            ?>
                            <option value="<?php echo $row["Deductions"] ?>"><?php echo $row["Deductions"] ?></option>
                            <?php
                        }
                        ?>
                    </select>

                    <label for="">Allowance</label>
                    <input type="number" class="form-control mb-3" name="Deduction">

                    <button type="submit" class="btn btn-block btn-success"  name="dedsubmit">Submit</button>
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
    include_once('../db/dbconnect.php');
    $sql = "SELECT * FROM employees ORDER BY SerialNo DESC Limit 1";
    $res = getDataFromDB($sql);
    $count = count($res);
    if($count == 0){
        $id = date('Y').'-0-0-'.'1';
    }
    else{
        foreach($res as $row){
          $subid = $row['SerialNo']+1;
            $id = date('Y').'-0-0-'.$subid;
        }
    }

    include_once('../db/db.php');
    $insert = "INSERT INTO `employees`( `Emp_ID`, `FName`, `LName`, `Email`, `Password`, `UserRole`, `Dept_ID`, `Pos_ID`, `Grade`) VALUES ('".$id."','".$_POST['FName']."','".$_POST['LName']."','".$_POST['Email']."','".md5(12345)."','Faculty','".$_POST['Dept_ID']."','".$_POST['Position_ID']."','".$_POST['Grade']."')";


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

elseif(isset($_POST['alsubmit'])){
    $sql = "INSERT INTO `allowancesamount`( `Emp_ID`, `AllowancesTerm`, `Amount`) VALUES ('".$_POST["Emp_ID"]."','".$_POST["Term"]."','".$_POST['Allowance']."')";

    include_once('../db/db.php');
    if($con->query($sql) ===  TRUE ){
    $_SESSION['msg'] = "Added Successfully";
//        echo $_SESSION['msg'];
      }

      else{
          echo $con->Error;
      }
}
elseif(isset($_POST['dedsubmit'])){
    $sql = "INSERT INTO `deductionamount`( `Emp_ID`, `DeductionTerm`, `Amount`) VALUES ('".$_POST["Emp_ID"]."','".$_POST["Term"]."','".$_POST['Deduction']."')";

    include_once('../db/db.php');
    if($con->query($sql) ===  TRUE ){
    $_SESSION['msg'] = "Added Successfully";
//        echo $_SESSION['msg'];
      }

      else{
          echo $con->Error;
      }
}
?>
