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
            font-size: 18px;
        }
    </style>
</head>
<body>
<?php
    include('partials/navbar.php');
    session_start();
    ?>

    <div class="container mt-3 p-4">
       <h2>Payroll</h2>
       <hr style="width: 100%; height: 2px">
        <div class="row">
            <div class="col-4">
                <form action="" class="login-form"  method="post">
                    <h4>Add New</h4>
                     <label for="">Department</label>
                    <select name="Department" class="form-control mb-3" id="">
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
                    <label for="">Starts From</label>
                    <input type="date" class="form-control mb-3" name="Start">

                    <label for="">Ends In</label>
                    <input type="date" class="form-control mb-3" name="End">
                    <label for="">Work Day</label>
                    <input type="number" class="form-control mb-3" name="WorkDay">
                    <button type="submit" class="btn btn-block btn-success"  name="submit">Submit</button>
                </form>
            </div>
            <div class="col-8">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Serial No</th>
                        <th>Dept. ID</th>
                        <th>Payroll ID</th>
                        <th>Starts From</th>
                        <th>Ends In</th>
                        <th>Work Day</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    include_once('../db/dbconnect.php');
    $sql = "SELECT * FROM payroll";
    $res = getDataFromDB($sql);
                    foreach($res as $row){
                        ?>
                        <tr>
                            <td><?php echo $row['SerialNo'] ?></td>
                            <td><?php echo $row['PayrollID'] ?></td>
                            <td><?php echo $row['Dept_ID'] ?></td>
                            <td><?php echo $row['Start'] ?></td>
                            <td><?php echo $row['End'] ?></td>
                            <td><?php echo $row['WorkDay'] ?></td>
                            <td><?php if( $row['Status'] == "New"){
                            ?>
                            <a href="calculate.php?id=<?php echo $row['PayrollID']?>" class="btn btn-outline-primary">Calculate</a>
                            <?php
                        }
                                else{
                                    ?>
                                    <a href="calculatedresult.php?id=<?php echo $row['PayrollID']?>" class="btn btn-outline-primary">View</a>
                                    <?php
                                }
                                ?></td>
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
    $sql = "SELECT * FROM payroll ORDER BY SerialNo DESC Limit 1";
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
    $insert = "INSERT INTO `payroll`( `PayrollID`, `Dept_ID`, `Start`, `End`, `WorkDay`) VALUES ('".$id."','".$_POST['Department']."','".$_POST['Start']."','".$_POST['End']."','".$_POST['WorkDay']."')";

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
