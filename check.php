<?php
/**
 * Created by PhpStorm.
 * User: Chanakya
 * Date: 9/16/2018
 * Time: 1:21 PM
 */
session_start();
include 'shop.html';
$conn=new mysqli("localhost", "root", "", "technopoly");
if($conn->connect_error)
{
    die("connection failed".$conn->connect_error);
}
$uname=$_SESSION["uname"];
//echo $uname;
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
$qid=array_keys($_POST);
$ans=$_POST['option'];
#print_r($_POST);
$sql="select * from question where qid='$qid[1]';";
if(($i1=$conn->query($sql))== false)
{
    echo $conn->error;
}
else{
    while($r1 = $i1->fetch_assoc()){
        $bal=$r['balance'];
        if($r1['level']==1)
            $cp=100;
        elseif($r1['level']==2)
            $cp=150;
        elseif($r1['level']==3)
            $cp=200;
        elseif($r1['level']==4)
            $cp=300;
        if($r1['correct_ans']==$ans){
            $sq2="update login
                  set balance=$bal+2*$cp
                  where uname='$uname'";
            if(($i2=$conn->query($sq2))== false)
            {
                echo $conn->error;
            }
            echo '<script language="javascript">';
            echo 'alert("correct answer")';
            echo '</script>';
        }
        else{
            echo '<script language="javascript">';
            echo 'alert("wrong answer")';
            echo '</script>';
        }
        $sq3="update question
              set status=1
              where qid='$qid[1]'";
        if(($i3=$conn->query($sq3))== false)
        {
            echo $conn->error;
        }
        header("loaction:shop.html");
    }
}
?>