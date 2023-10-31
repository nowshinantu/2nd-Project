<!DOCTYPE html>
<html>
  <head>
    <title>List</title>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css'>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <?php
        include('partials/navbar.php');
        session_start();
     ?>
     <div class="container mt-3 p-4">
        <h2>Employee List</h2>
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
                      <th>Salary</th>
                
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
                          <td><?php echo $row['Salary'] ?></td>
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
   <script src='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js'></script>
   <script  src="js/script.js"></script>
  </body>
</html>
