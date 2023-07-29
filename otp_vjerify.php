<?php
session_start();
 require_once 'config/Database.php';
 require_once 'function/functions.php';
 $db_instance = new Database();
 $conn = $db_instance->connect();


if(isset($_POST['verify'])){
  if(otp_verify($_SESSION['user']['email'],$_POST['otp'])){
    echo "<script>alert('correct')</script>";
  }else{
    echo "<script>alert('wrong otp')</script>";
  }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
</head>
<body> 
   <div class="wrapper">
     <img src="bad.png" alt="">
    <div class="form-wrapper login">
      <form action="" method="post">
        <h2 class="text-right">Verification</h2>
        <div class="input-box">
          <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
          <input type="number" id="otp" name="otp" placeholder="OTP" required>
        </div>
        <div class="forgot-pass">
          <a href="#">Resend OTP ?</a>
        </div>
        <button type="submit" name='verify'>Verify</button>
       
      </form>
    </div>
   </div>
   <script>

   </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
   
</html>