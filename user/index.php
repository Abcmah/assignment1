<?php
session_start();
if(!isset($_SESSION['user']['is_verified']) || !$_SESSION['user']['is_authenticated']){
  header('location: ../login.html');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/index.css">
    <title>User</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
          <h2><a href="home.html">BamStarTech</a> </h2>
        </div>
        <div class="navigation">
          <ul>
            <li><a href="index.html"><span class="icon"><ion-icon name="home"></ion-icon></span>Home</a></li>
            <li><a href="#"><span class="icon"><ion-icon name="information-circle"></ion-icon></span>About us</a></li>
            <li><a href="service.html"><span class="icon"><ion-icon name="business"></ion-icon></span>Services</a></li>
            <li><a href="#"><span class="icon"><ion-icon name="call"></ion-icon></span>Contact</a></li>
            <li><a href="login.html"><span class="icon"><ion-icon name="person"></ion-icon></span><?=$_SESSION['user']['name']?></a></li>
            <li><a href="../logout.php"><span class="icon"><ion-icon name="person"></ion-icon></span>logout</a></li>
          </ul>
        </div>
      </div>
      <style>
        .container{
            width: 80%;
            margin:auto;
        }
        .services{
            padding-top: 3rem;
            text-align: center;
        }
      </style>
    <div class="container">
        <div class="services">
            <p>Dear user you have not subscribed to any service, <a href="http:/">Explore Services</a></p>
        </div>
        <div class="admin-view">
            <p>No of users in the Database : 3</p>
            
        </div>
    </div>
</body>
</html>