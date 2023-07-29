<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Perform basic validation
  if (empty($username) || empty($password)) {
    echo "Please fill in all fields.";
    exit;
  }

  // Hash the password
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  // Assume the registration is successful
  $message = "Registration successful!";

  // Generate a random OTP
  $otp = rand(100000, 999999);

  // Store the user in the database
  // Replace the database credentials and table name with your own
  $servername = "localhost";
  $db_username = "bonykyme";
  $db_password = "bonykyme";
  $dbname = "bamstar";


  // Create a connection
  $conn = new mysqli($servername, $db_username, $db_username, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
   // Check if the username already exists in the database
   $checkQuery = "SELECT * FROM users WHERE username='$username'";
   $checkResult = $conn->query($checkQuery);
   if ($checkResult->num_rows > 0) {
    //  echo "Username already exists. Please choose a different username.";
    ?>
    <script>
      alert("Username already exists. Please choose a different username.");
      window.location.href = "login.html"; // Redirect back to the registration page
    </script>
    <?php
     $conn->close();
     exit;
   }

  // Insert the user into the database
  $sql = "INSERT INTO users (username, password,otp) VALUES ('$username', '$hashedPassword', '$otp')";
  if ($conn->query($sql) === TRUE) {
    ?>
    <script>
      alert("Bingo!! Registration Successful \uD83D\uDE00");
      window.location.href = "login.html"; // Redirect back to the registration page
    </script>
    <?php
     $conn->close();
     exit;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
}
?>
