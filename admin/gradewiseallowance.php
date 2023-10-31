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
       <h2>Grades</h2>
       <hr style="width: 40%; height: 2px">
        <div class="row">
            <div class="col-5">
                <form action="" class="login-form"  method="post">

                    <label for="">Grades</label>
                    <select name="Grade" class="form-control mb-3"  id="">
                        <option value="">Select a grade</option>
                        <?php
                        $sql = "SELECT * FROM grades";

                    include_once('../db/dbconnect.php');
                        $sres = getDataFromDB($sql);
                        foreach($sres as $row){
                            ?>
                            <option value="<?php echo $row["GradeName"] ?>"><?php echo $row["GradeName"] ?></option>
                            <?php
                        }
  ?>
                    </select>

                    <label for="">Amount Title</label>
                    <select name="AmountTitle" class="form-control mb-3" id="">
                        <option value="">Select a title for the amount</option>
                         <option value="Allowance">Basic</option>
                        <option value="House Rent">House Rent</option>
                        <option value="Medical">Medical</option>
                        <option value="Dearness">Dearness</option>
                        <option value="Bonus">Bonus</option>
                        <option value="Others">Others</option>

                    </select>
                    <label for="">Amount</label>
                    <input type="Number" step="2" class="form-control mb-3" name="Amount">

                    <button type="submit" class="btn btn-block btn-success"  name="submit">Submit</button>
                </form>
            </div>
            <div class="col-7">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Serial No</th>
                        <th>Grades</th>
                        <th>Amount Title</th>
                        <th>Amount</th>

                    </tr>
                    <?php
                    include_once('../db/dbconnect.php');
    $sql = "SELECT * FROM gradewiseallowance";
    $res = getDataFromDB($sql);
                    foreach($res as $row){
                        ?>
                        <tr>
                            <td><?php echo $row['SerialNo'] ?></td>
                            <td><?php echo $row['GradeName'] ?></td>
                            <td><?php echo $row['ChargeName'] ?></td>
                            <td><?php echo $row['Amount'] ?></td>
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

    include_once('../db/db.php');
    $insert = "INSERT INTO `gradewiseallowance`(`GradeName`, `ChargeName`, `Amount`) VALUES ('".$_POST['Grade']."','".$_POST['AmountTitle']."','".$_POST['Amount']."')";

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
