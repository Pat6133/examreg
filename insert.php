<?php
$Name = $_POST['Name'];
$Password = $_POST['Password'];
$Address = $_POST['Address'];
$ExamName = $_POST['ExamName'];
$ZIPCode = $_POST['ZIPCode'];
$Email = $_POST['Email'];
$Sex = $_POST['Sex'];
$comments = $_POST['comments'];
if (!empty($Name) ||  !empty($Password) ||  !empty($Address)||  !empty($ExamName)||  !empty($ZIPCode)||  !empty($Email)||  !empty($Sex)||  !empty($comments)) {
 $host = "localhost";
 $dbUsername = "root";
 $dbPassword = "";
 $dbname = "registration";
    //create connection
 $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
 if (mysqli_connect_error())
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
else {
   $SELECT = "SELECT Email From signup Where Email = ? Limit 1";
   $INSERT = "INSERT Into signup (Name,Password,Address,ExamName,ZIPCode,Email,Sex,comments) values(?,?,?,?,?,?,?,?)";
     //Prepare statement
   $stmt = $conn->prepare($SELECT);
   $stmt->bind_param("ss", $Email,$Password);
   $stmt->execute();
   $stmt->bind_result($Email,$Password);
   $stmt->store_result();
   $rnum = $stmt->num_rows;
   if ($rnum==0) {
    $stmt->close();
    $stmt = $conn->prepare($INSERT);
    $stmt->bind_param("ssssisss", $Name,$Password,$Address,$ExamName,$ZIPCode,$Email,$Sex,$comments);
    $stmt->execute();
    echo "New record inserted sucessfully";
  } else {
    echo "Someone already register using this email";
  }
  $stmt->close();
  $conn->close();
}
}  
else {
 echo "All field are required";
 die();
}
header("location: HP.html");
?>
