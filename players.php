<?php

session_start();

$conn=new mysqli("localhost","root","","technopoly");

if(!$conn){
    die("Connection failed". $conn->connect_error);
}
$uname=$_SESSION['uname'];
$sq="SELECT * FROM login where uname='$uname'";
if(($r=$conn->query($sq))== false)
echo $conn->error;
else{
if($r->num_rows)
{
    while($i=$r->fetch_assoc()){
        $uid=$i['uid'];
        break;
    }
}
}

$sql="SELECT * FROM login order by balance desc";
if(($r1=$conn->query($sql))== false)
    echo $conn->error;
else{
    if($r1->num_rows)
    {
        $rank=1;
        echo '<!DOCTYPE html>
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
<div class="container players-container">
    <div class="panel">
        <div class="panel-body">
            <table class="table">
                <thead>
                <tr>
                    <th><h4>Player</h4></th>
                    <th><span style="display:inline-block; width: 100px;"></span></th>
                    <th><h4>Rank</h4></th>
                </tr>
                </thead></table></div>';
        while($i1=$r1->fetch_assoc())
        {
            if($uid==$i1['uid']) {
                echo "<html><body ><div class='d1' style='font: 26px bold;background:lightcoral'><br>
                <table>
                <col width=\"20\">
                <col width=\"860\">
                <col width=\"80\">
                <tr>
                <td><span style=\"display:inline-block; width: 16px;\"></span></td>
                <td>" . "  " . $i1['uname'] . "</td>
               
                <td>" . $rank . "</td>
               
                </tr>
                </table><br></div><br></body></html>";
            }
            else{
                echo "<html><body ><div class='d1' ><br>
                <table>
                <col width=\"20\">
                <col width=\"860\">
                <col width=\"80\">
                <tr>
                <td><span style=\"display:inline-block; width: 16px;\"></span></td>
                <td>" . "  " . $i1['uname'] . "</td>
               
                <td>" . $rank . "</td>
               
                </tr>
                </table><br></div><br></body></html>";
            }
            $rank = $rank + 1;
        }
    }
}
?>

<style>
    div.d1 {
        border-radius: 20px;

        font: 20px bold ;
        color: black;
        font-weight: bold;
    }
</style>
