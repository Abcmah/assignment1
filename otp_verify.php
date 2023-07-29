<?php
session_start();
if(!isset($_SESSION['user']['is_authenticated'])){
  header('location: login.html');
}
 require_once 'config/Database.php';
 require_once 'function/functions.php';
 $db_instance = new Database();
 $conn = $db_instance->connect();


if(isset($_POST['verify'])){
  if(otp_verify($_SESSION['user']['email'],$_POST['otp'])){
    $_SESSION['user']['is_verified']=true;
    echo "<script>alert('correct')</script>";
    echo "<script>location.href='user'</script>";
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
  <link rel="stylesheet" href="./style/index.css">
  <title>OTP verification</title>
</head>
<body> <div class="nav">
  <div class="logo">
    <h2><a href="home.html">BamStarTech</a> </h2>
  </div>
  <div class="navigation">
    <ul>
      <li><a href="home.html"><span class="icon"><ion-icon name="home"></ion-icon></span>Home</a></li>
      <li><a href="#"><span class="icon"><ion-icon name="information-circle"></ion-icon></span>About us</a></li>
      <li><a href="#"><span class="icon"><ion-icon name="business"></ion-icon></span>Services</a></li>
      <li><a href="#"><span class="icon"><ion-icon name="call"></ion-icon></span>Contact</a></li>
      <li><a href="login.html"><span class="icon"><ion-icon name="person"></ion-icon></span>User</a></li>
    </ul>
  </div>
</div>
   <div class="wrapper">
     <img src="./images/panda.png" alt="">
     <!-- <h2 class="text-right">Welcome</h2> -->
    <div class="form-wrapper login">
      <form action="" method="post">
        <!-- <h2 class="text-right">BamStar</h2> -->
        <h2>Verication</h2>
        <div class="input-box">
          <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
          <input maxlength="6" type="number" id="otp" name="otp" placeholder="OTP" required>
        </div>
        <!-- <div class="input-box">
          <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
          <input type="text" id="otp" name="otp" placeholder="OTP" >
        </div> -->
        <div class="forgot-pass">
          <a href="#">Resend OTP ?</a>
        </div>
        <button type="submit" name='verify'>Verify</button>
      </form>
    </div>
    
   </div>
   
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="./js/script.js"></script>
</body>
</html>