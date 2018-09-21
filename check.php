<?php

session_start();
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
$sql="delete from market where qid='$qid[1]';";
if(($i1=$conn->query($sql))== false)
{
    echo $conn->error;
}
$sql="select * from question where qid='$qid[1]';";
if(($i1=$conn->query($sql))== false)
{
    echo $conn->error;
}
else{
    while($r1 = $i1->fetch_assoc()){
        $bal=$r['balance'];
        $cp=$r1['price'];
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
        header('Refresh:0; url=shop.html');
    }
}
?>
