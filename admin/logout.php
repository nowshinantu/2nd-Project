<?php
  session_start();
    $_SESSION["user_role"] = '';
    $_SESSION["username"] = '';
    $_SESSION["flag"] = '';

      header("Location: ../index.php");

 ?>
