
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
$sql="select * from question where status=0 and level=1;";
if(($r=$conn->query($sql))== false)
        echo $conn->error;
else
{
    if($r->num_rows)
    {
    while($i=$r->fetch_assoc())
    {
        $a=$i['qid'];
       echo "<html><body><form action='question.php' method='POST'>
       <table align='center' width='10' cellspacing='7' cellpadding='5'>
       <tr>
               <td colspan='2'><b>Question:</b></td>
               <td>$a</td>
               <td>  </td>
               <td colspan='3'><input type='submit' name='$a' value='BUY for 100'/></td>
       </tr>
       </table></form></body></html>";

    }
    }
 else {
        echo "<html><body style=''><br>No questions left visit again
            <br><br></body></html>";
    }
}
?>
