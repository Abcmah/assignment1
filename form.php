<?php
session_start();
 require_once 'config/Database.php';
 require_once 'function/functions.php';
 $db_instance = new Database();
 $conn = $db_instance->connect();
 if(isset($_POST['register'])){
  $sql = "SELECT email FROM user";
  $stmt1 = $conn->query($sql);
  echo($stmt1->rowCount());
  if($stmt1->rowCount() <= 2){
    $query = "INSERT INTO user (`full_name`, `username`, `email`, `password`, `otp`) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $res = $stmt->execute([$_POST['full_name'],generate_username($_POST['full_name']), $_POST['email'], password_hash($_POST['password'], PASSWORD_DEFAULT), generate_otp($_POST['email'])]);
    if($res){
      echo "<script>alert('registion succeded')</script>";
    }else{
      echo "<script> alert('something went wrong')</script>";
    }
  }else{
    echo "<script> alert('sorry only 3 users are accepted')</script>";
  }
 }

if(isset($_POST['login'])){
  if(authenticate($_POST['email'],$_POST['password'])){
    header('location: otp_verify.php');
  }else{
    echo "<script>alert('Incorrect email OR password')</script>";
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
        <h2 class="text-right">Welcome! login</h2>
        <div class="input-box">
          <span class="icon"><ion-icon name="mail"></ion-icon></span>
          <input type="email" id="username" name="email" placeholder="Email" required>
        </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
          <input type="password" id="password" name="password" placeholder="Password" required>
        </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
          <input type="text" id="otp" name="otp" placeholder="OTP" disabled>
        </div>
        <div class="forgot-pass">
          <a href="#">forgot password</a>
        </div>
        <button type="submit" name='login'>Login</button>
        <div class="sing-link">
          <p>Don't have an account?<a href="#" onclick="registerActive()">Register</a></p>
        </div>
      </form>
    </div>
    <div class="form-wrapper register">
      <form action="" method="post">
        <h2>Registration</h2>
        <div class="input-box">
          <span class="icon"><ion-icon name="person"></ion-icon></span>
          <input type="text" id="name" name="full_name" placeholder="Full Name" required>
        </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="mail"></ion-icon></span>
          <input type="email" id="username" name="email" placeholder="Email address" required>
        </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
          <input type="password" id="password" name="password" placeholder="Password" required>
        </div>
        <div class="input-box">
          <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
          <input type="password" id="password" name="cpassword" placeholder="Confirm Password" required>
        </div>
        <button name="register" type="submit">Register</button>
        <div class="sing-link">
          <p>Already have an account?<a href="#" onclick="loginActive()">login</a></p>
        </div>
      </form>
    </div>
   </div>
   <script>

   </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
      const wrapper = document.querySelector('.wrapper');

function registerActive(){
  wrapper.classList.toggle('active');
}

function loginActive(){
  wrapper.classList.toggle('active');
}
    </script>
</body>
</html>