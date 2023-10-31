<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css'>
    <link rel="stylesheet" href="css/style.css">
<style media="screen">
  body{
    background-image: url(../some.jpg);
    background-repeat: no-repeat;
    background-size: 100% 100%;
    height: 100vh;
    width: 100%;
  }
  h1{
    margin-top: 130px;
    color: #5161CE;
    margin-left: 80px;
    background-color: #f8f9fa;
    width: 55%;
  }
  p{
    width: 50%;
    margin-left: 80px;
    margin-top: 15px;
    font-size: 20px;
    font-weight: bold;
    color: #5161CE;
    background-color: #f8f9fa;

  }
</style>
</head>
<body>
<?php
    include('partials/nav.php');
    ?>

      <h1>Welcome to
        Payroll Management System</h1>

      <p>This Payroll Management System manage your paying issues.
        like, it Store Employees information,
        Collect payroll schedule.
        Calculate payroll.
      </p>


  <script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
  <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js'></script>
  <script src='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js'></script><script  src="js/script.js"></script>

</body>
</html>
