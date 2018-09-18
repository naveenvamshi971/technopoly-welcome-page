<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Logged In</title>
</head>
<body>
</body>
</html>

<?php
session_start();
$password = $_POST['userPassword'];
$username = $_POST['userNameInput'];
$_SESSION["uname"]=$username;
$conn=new mysqli("localhost", "root", "", "technopoly");
if($conn->connect_error)
{
    die("connection failed".$conn->connect_error);
}
$sq="select * from login where uname='$username' and password='$password'";
if(($r=$conn->query($sq))== false)
    echo $conn->error;
else {
    if ($r->num_rows) {
        header("location:index1.html");
        }
     else{
         echo '<script language="javascript">';
         echo 'alert("your not a valid user")';
         echo '</script>';
         include "login.html";
     }
}

?>
