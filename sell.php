<?php
/**
 * Created by PhpStorm.
 * User: Chanakya
 * Date: 9/17/2018
 * Time: 8:12 PM
 */
session_start();
$qid=$_GET["var"];
$uname=$_SESSION['uname'];
$conn=new mysqli("localhost", "root", "", "technopoly");
if($conn->connect_error)
{
    die("connection failed".$conn->connect_error);
}
$sq="select * from login where uname='$uname'";
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
$uid=$r['uid'];
$sq1="select * from question where qid=$qid";
if(($i1=$conn->query($sq1))== false)
{
    echo $conn->error;
}
else{
    if($i1->num_rows){
        while($r1=$i1->fetch_assoc()){
            break;
        }
    }
}
$sq2="insert into market(qid,uid) values($qid,$uid)";
if(($i2=$conn->query($sq2))== false)
{
    echo $conn->error;
}
$cp=$r1['price'];
$cp=$cp*0.8;
$sq3="update question set price=$cp where qid=$qid";
if(($i3=$conn->query($sq3))== false)
{
    echo $conn->error;
}
$sq4="update question set status=2 where qid=$qid";
if(($i4=$conn->query($sq4))== false)
{
    echo $conn->error;
}
header('Refresh:0; url=index1.html');
echo '<script language="javascript">';
echo 'alert("sold succsfully")';
echo '</script>';
?>
