<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
// function check_user1_limit(){
//     $db_instance = new Database();
//     $conn = $db_instance->connect();
//     $query = "SELECT email from user";
//     $stmt = $conn->prepare($query);
//     $result = $stmt->execute() ? $stmt->fetch(PDO::FETCH_ASSOC) : false;
//     if($result){
//         $user_num = cout($result);
//         print_r($result);
//     }
// }
function generate_username($name){
    return 'not set';
}
function generate_otp($email){
    $otp = rand(100000, 999999);
    $query = "UPDATE user SET `otp` = '${otp}' WHERE email = ?";
    $db_instance = new Database();
    $conn = $db_instance->connect();
    $stmt = $conn->prepare($query);
    if(!$stmt->execute([$email])){
        echo "<script>alert('erro')</script>";
    }
    return $otp;
}
function purge_otp($email){
    $query = "UPDATE user SET `otp` = '' WHERE email = ?";
    $db_instance = new Database();
    $conn = $db_instance->connect();
    $stmt = $conn->prepare($query);
    if(!$stmt->execute([$email])){
        echo "<script>alert('erro')</script>";
    }
    return true;
}
function authenticate($email, $password){
    $query = "SELECT user_id, email, password,full_name FROM user WHERE `email` = ?";
    $db_instance = new Database();
    $conn = $db_instance->connect();
    $stmt = $conn->prepare($query);
    if($stmt->execute([$email])){
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount() > 0){
            if(password_verify($password, $user['password'])){
                $_SESSION['user']=[
                    'is_authenticated'=>true,
                    'name'=> $user['full_name'],
                    'email'=> $user['email'],
                ];
                send_otp($email, generate_otp($email));
                return true;
            }else{
                return false;
            }
        }
    }
}
function otp_verify($email, $user_otp){
    $query = "SELECT otp FROM user WHERE `email` = ? LIMIT 0,1";
    $db_instance = new Database();
    $conn = $db_instance->connect();
    $stmt = $conn->prepare($query);
    if($stmt->execute([$email])){
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if(strlen($user_otp) == 6){
            if($user['otp'] == $user_otp){
                purge_otp($email);
                return true;
            }
            else{
                return false;
            }
        }else{
            echo "<script>alert('OTP must contain 6 digits')</script>";
        }
    }else{
        echo "<script>alert('something went wrong')</script>";
    }
}

function send_otp($email, $otp){
    require 'assests/vendor/phpmailer/src/Exception.php';
    require 'assests/vendor/phpmailer/src/PHPMailer.php';
    require 'assests/vendor/phpmailer/src/SMTP.php';
    require 'config/SMTP.php';

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host =$my_smtp;
    $mail->SMTPAuth = $smtp_auth;
    $mail->Username =$my_username;
    $mail->Password = $my_password; //'mnvfpjxahotfyvys';
    $mail->SMTPSecure =$smtp_secure;
    $mail->Port =$port;
    $mail->setFrom($my_username);
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = "OTP";
    $mail->Body = $otp;
    $mail->send();
    // echo"<script></script>";
    // exit;
}
?>