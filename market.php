<?php
/**
 * Created by PhpStorm.
 * User: Chanakya
 * Date: 9/19/2018
 * Time: 8:34 AM
 */
session_start();
include 'market.html';
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
$uid=$r['uid'];
echo $uid;
$sq1="select * from market where uid<>'$uid'";
if(($i1=$conn->query($sq1))== false) {
    echo $conn->error;
}
else{
    if($i1->num_rows){
        while($r1=$i1->fetch_assoc()){
            $qid=$r1['qid'];
            $sq2="select * from question where qid='$qid'";
            if(($i2=$conn->query($sq2))== false)
            {
                echo $conn->error;
            }
            else{
                if($i2->num_rows){
                    while($r2=$i2->fetch_assoc()){
                        $price=$r2['price'];
                        $level=$r2['level'];
                        echo "<html><body ><div class='d1'><br><form action='question.php' method='POST'>
                            <table width='10' cellspacing='20' cellpadding='5'>
                            <tr>
                                <td><span style=\"display:inline-block; width: 40px;\"></span></td>                            
                                <td>$qid</td>
                                <td><span style=\"display:inline-block; width: 420px;\"></span></td>
                                <td>$level</td>
                                <td><span style=\"display:inline-block; width: 225px;\"></span></td>
                                <td>$price </td>
                                <td><span style=\"display:inline-block; width: 200px;\"></span></td>
                                <td colspan='3'><input type='submit' name='$qid' value='BUY'/></td>
                            </tr>
                            </table></form><br></div></body></html>";

                    }
                }
            }
        }
    }
}
?>


