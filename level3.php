<?php
/**
 * Created by PhpStorm.
 * User: Chanakya
 * Date: 9/16/2018
 * Time: 12:01 PM
 */
session_start();
include 'shop.html';
$conn=new mysqli("localhost", "root", "", "technopoly");
if($conn->connect_error)
{
    die("connection failed".$conn->connect_error);
}
$sql="select * from question where status=0 and level=3;";
if(($r=$conn->query($sql))== false)
    echo $conn->error;
else
{
    if($r->num_rows)
    {
        while($i=$r->fetch_assoc())
        {
            $a=$i['qid'];
            echo "<html><body ><div class='d1'><br><form action='question.php' method='POST'>
       <table align='center' width='10' cellspacing='20' cellpadding='5'>
       <tr>
               <td colspan='2'><b>Question:</b></td>
               
               <td>$a</td>
               <td><span style='display:inline-block; width: 400px;'></span></td>
               <td colspan='3'><input type='submit' name='$a' value='BUY for 200'/></td>
       </tr>
       </table></form><br></div></body></html>";

        }
    }
    else {
        echo "<html><body style=''><div class='d1'><br><span style=\"display:inline-block; width: 350px;\"></span>No questions left visit again
            <br><br></body></html>";
    }
}
?>
