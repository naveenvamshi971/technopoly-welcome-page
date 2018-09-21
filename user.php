<?php
/**
 * Created by PhpStorm.
 * User: Chanakya
 * Date: 9/21/2018
 * Time: 1:58 PM
 */
session_start();
$conn=new mysqli("localhost", "root", "", "technopoly");
if($conn->connect_error)
{
    die("connection failed".$conn->connect_error);
}
$uname=$_SESSION["uname"];
$sq="select * from login where uname='$uname';";
if(($i=$conn->query($sq))== false)
{
    echo $conn->error;
}
else{
    if($i->num_rows){
        while($r=$i->fetch_assoc()){
            break;
        }
    }

}
$balance=$r['balance'];
$uid=$r['uid'];
echo'<!DOCTYPE html>
<html lang="en">
<head>
    <title>Technopoly</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/script.js"></script>
    <script src="./js/question.js"></script>
    <script src="./js/store.js"></script>
    <script src="./js/market.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-route.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-sanitize.min.js"></script>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="./Hover/css/hover-min.css">
</head>
<body ng-app="myApp" ng-controller="user">
<a class="main home" href="index1.html"  id="main" onmouseover="disp()">
    <span class="hvr-buzz-out hvr-grow"><i class="fa fa-home fa-lg text-center" aria-hidden="true"></i><br/>Home</span>
</a>
<div class="container user-container">
    <div class="panel panel-default text-center" style="font-size:20px;margin-bottom:0px;">
        <div class="panel-body" style="padding:5px;">
            <span style="float:left">Username:'.$uname.'</span>
            <span style="float:right">Coins:'.$balance.'<?php echo $balance?></span>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" style="padding:5px;"><h3>Questions Sold</h3></div>
        <div class="panel-body" style="padding:5px;">';
$sq1="select * from market where uid='$uid';";
if(($i1=$conn->query($sq1))== false)
{
    echo $conn->error;
}
else{
    if($i1->num_rows){
        while($r1=$i1->fetch_assoc()){
           $qid=$r1['qid'];
            $sq2="select * from question where qid=$qid";
            if(($i2=$conn->query($sq2))== false)
            {
                echo $conn->error;
            }
            else{
                if($i2->num_rows){
                    while($r2=$i2->fetch_assoc()){
                        $price=$r2['price'];
                        echo"<html><body ><div class='d1'><br>
       <table align='center' width='10' cellspacing='20' cellpadding='5'>
       <tr>
               <td colspan='2'><b>Question:</b></td>
               <td>$qid</td>
               <td><span style=\"display:inline-block; width: 400px;\"></span></td>
               <td colspan='2'><b>Price:</b></td>
               <td>$price</td>
               
       </tr>
       </table><br></div><br></body></html>";
                        break;
                    }
                }
            }
        }
    }

}
?>

<style>
    div.d1 {
        position: relative;
        border-radius: 20px;
        background: linear-gradient(darkgrey,whitesmoke);
        font: 20px bold ;
        color: black;
        font-weight: bold;
        text-shadow: 4px 4px 4px whitesmoke;
    }
</style>


