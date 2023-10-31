<!DOCTYPE html>
<html>
  <head>
    <title>loginpage</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="style.css">

  </head>
  <body>
    <div class="container bg-light nows">
      <div class="row">
        <div class="imagebox col-6">
          <img src="pic.png" alt="">
        </div>
        <div class="loginbox col-6">
          <div class="login">
            <form action="login.php" method="post">
             <h1 align="center">Login</h1>

               <input type="text" class="form-control mt-4" name="username" placeholder="Username" required>
               <input type="password" class="form-control mt-2" name="password" placeholder="Password" required>

               <!-- <select class="form-control mt-2" name="user_role">
                 <option>Select User Role</option>
                 <option>Admin</option>
                 <option>Employee</option>
               </select> -->

               <button type="submit" class="mt-4 btn btn-block btn-primary">Submit</button>

         </form>

          </div>
        </div>





      </div>
    </div>

  </body>
</html>
