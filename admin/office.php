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
       <h2>Office</h2>
       <hr style="width: 40%; height: 2px">
        <div class="row">
            <div class="col-5">
                <form action="" class="login-form"  method="post">

                    <label for="">Sections</label>
                    <select name="Department" class="form-control mb-3" id="">
                        <option value="">Select a Section</option>
                        <?php
                    include_once('../db/dbconnect.php');
    $sql = "SELECT * FROM administration";
    $res = getDataFromDB($sql);
                    foreach($res as $row){
                        ?>
                        <option value="<?php echo $row['serialno'] ?>"><?php echo $row['serialno'].' - '.$row['admin_name'] ?></option>

                        <?php
                    }
                    ?>
                    </select>
                    <label for="">Position</label>
                    <input type="text" class="form-control mb-3" name="position">

                    <!-- <label for="">Short Details</label>
                    <input type="text" class="form-control mb-3" name="positionshort"> -->


                    <button type="submit" class="btn btn-block btn-success"  name="submit">Submit</button>
                </form>
            </div>
            <div class="col-7">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Serial No</th>
                        <th>Dept ID</th>
                        <th>PositionID</th>
                        <th>Position</th>
                        <!-- <th>Position Details</th> -->
                        <th>Action</th>
                    </tr>
                    <?php
                    include_once('../db/dbconnect.php');
    $sql = "SELECT * FROM office_position";
    $res = getDataFromDB($sql);
                    foreach($res as $row){
                        ?>
                        <tr>
                            <td><?php echo $row['SerialNo'] ?></td>
                            <td><?php echo $row['Admin_ID'] ?></td>
                            <td><?php echo $row['OPositionID'] ?></td>
                            <td><?php echo $row['Position'] ?></td>
                             <td><!--<a href="editdept.php?<?php echo $row['OPositionID'] ?>" class="btn btn-warning btn-sm">Edit</a> -->
                              <a href="deletedept.php?<?php echo $row['OPositionID'] ?>" class="btn btn-danger btn-sm">Delete</a></td>
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
    $sql = "SELECT * FROM office_position ORDER BY SerialNo DESC Limit 1";
    $res = getDataFromDB($sql);
    $count = count($res);
    if($count == 0){
        $id = date('Y').'-1-'.'1';
    }
    else{
        foreach($res as $row){
          $subid = $row['SerialNo']+1;
            $id = date('Y').'-1-'.$subid;
        }
    }

    include_once('../db/db.php');
    $insert = "INSERT INTO `office_position`( `OPositionID`, `Admin_ID`, `Position`) VALUES ('".$id."','".$_POST["Department"]."','".$_POST["position"]."')";


    if($con->query($insert) ===  TRUE ){
    $_SESSION['msg'] = "Added Successfully";
        echo $_SESSION['msg'];
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
