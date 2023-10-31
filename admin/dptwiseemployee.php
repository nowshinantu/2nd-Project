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
       <h2>Employees of Department - <?php echo $_GET['id'] ?></h2>
       <hr style="width: 100%; height: 2px">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Serial No</th>
                        <th>Dept ID</th>
                        <th>Department</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Employee ID</th>
                    </tr>
                    <?php
                    include_once('../db/dbconnect.php');
    $sql = "SELECT *,departments.Dept_ID as D_ID FROM employees INNER JOIN departments ON departments.Dept_ID = employees.Dept_ID WHERE departments.Dept_ID = '".$_GET["id"]."'";
    $res = getDataFromDB($sql);
                    foreach($res as $row){
                        ?>
                        <tr>
                            <td><?php echo $row['SerialNo'] ?></td>
                            <td><?php echo $row['D_ID'] ?></td>
                            <td><?php echo $row['Departtment'] ?></td>
                            <td><?php echo $row['FName'].' '.$row['LName'] ?></td>
                            <td><?php echo $row['Email']?></td>
                            <td><?php echo $row['Emp_ID']?></td>
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
    include_once('../db/dbconnect.php');
    $sql = "SELECT * FROM departments ORDER BY SerialNo DESC Limit 1";
    $res = getDataFromDB($sql);
    $count = count($res);
    if($count == 0){
        $id = date('Y').'-'.'1';
    }
    else{
        foreach($res as $row){
            $subid = $row['SerialNo']+1;
//            echo $subid;
            $id = date('Y').'-'.$subid;
        }
    }

    include_once('../db/db.php');
    $insert = "INSERT INTO `departments`(`Dept_ID`, `Departtment`, `Dept_Details`) VALUES ('".$id."','".$_POST["department"]."','".$_POST["deptshort"]."')";

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
?>
