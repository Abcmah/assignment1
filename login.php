<?php
session_start(); // Start the session

  require_once 'config/Database.php';
  require_once 'function/functions.php';
  $db_instance = new Database();
  $conn = $db_instance->connect();
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if(isset($_POST['register'])){
   $sql = "SELECT email FROM user";
   $stmt1 = $conn->query($sql);
   echo($stmt1->rowCount());
   if($stmt1->rowCount() <= 2){
     $query = "INSERT INTO user (`full_name`, `username`, `email`, `password`, `otp`) VALUES (?, ?, ?, ?, ?)";
     $stmt = $conn->prepare($query);
     $res = $stmt->execute([$_POST['full_name'],generate_username($_POST['full_name']), $_POST['email'], password_hash($_POST['password'], PASSWORD_DEFAULT), generate_otp($_POST['email'])]);
     if($res){
       echo "<script> alert('registion succeded')</script>";
       echo "<script> location.href='login.html'</script>";
     }else{
       echo "<script> alert('something went wrong')</script>";
       echo "<script> location.href='login.html'</script>";
     }
   }else{
     echo "<script> alert('sorry only 3 users are accepted')</script>";
    //  echo "<script> location.href='login.html'</script>";
     echo "<script> location.href='index.html'</script>";
   }
  }
 
 if(isset($_POST['login'])){
   if(authenticate($_POST['email'],$_POST['password'])){
     header('location: otp_verify.php');
   }else{
     echo "<script>alert('Incorrect email OR password')</script>";
     echo "<script>location.href='login.html'</script>";
   }
 }
}
 