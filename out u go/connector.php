<?php

$email  = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];




if (!empty($email) || !empty($password))
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "user";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT email From signup Where email = ? Limit 1";
  $INSERT = "INSERT Into signup (email ,password, confirm_password)values(?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sss", $email, $password, $confirm_password);
      $stmt->execute();
      echo "Account created sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>