<?php
/**
 * Created by PhpStorm.
 * User: Chanakya
 * Date: 9/16/2018
 * Time: 12:32 PM
 */
session_start();
#include 'shop.html';
$conn=new mysqli("localhost", "root", "", "technopoly");
if($conn->connect_error)
{
    die("connection failed".$conn->connect_error);
}
$qid=array_keys($_POST);
$uname=$_SESSION["uname"];
//echo $uname;
$sq4="select * from login where uname='$uname';";
if(($i4=$conn->query($sq4))== false)
{
    echo $conn->error;
}
else{
    if($i4->num_rows){
        while($r4=$i4->fetch_assoc()){
            break;
        }
    }
}
$sql="select * from question where qid='$qid[0]';";
$sq2="select * from options where qid='$qid[0]';";
if(($i=$conn->query($sql))== false or ($i1=$conn->query($sq2))== false)
{
    echo $conn->error;
}
else {
    $r;
    while($r = $i->fetch_assoc())
    {
        $ques=$r['question'];
        $x=$qid[0];
        echo "<html><body>
       <table width='10' cellspacing='7' cellpadding='5'>
       <tr>
               <td>$x.$ques</td>
       </tr>
      
       </table></body></html>";
        $level=$r['level'];
    }

    $bal=$r4['balance'];
    $cp=$r4['price'];
    $sq3="update login
                  set balance=$bal-$cp
                  where uname='$uname'";
    if(($i3=$conn->query($sq3))== false)
    {
        echo $conn->error;
    }
    while($r1 = $i1->fetch_assoc()){
        $option1=$r1['option-1'];
        $option2=$r1['option-2'];
        $option3=$r1['option-3'];
        $option4=$r1['option-4'];
        echo "<html><body><form action='check.php' method='POST'>
       <table  width='10' cellspacing='7' cellpadding='5'>
       <tr>
               <td><input type='radio' name='option' value='1'></td>
               <td>$option1</td>
       </tr>
        <tr>
               <td><input type='radio' name='option' value='2'></td>
               <td>$option2</td>
       </tr>
        <tr>
               <td><input type='radio' name='option' value='3'></td>
               <td>$option3</td>
       </tr>
        <tr>
               <td><input type='radio' name='option' value='4'></td>
               <td>$option4</td>
       </tr>
       <tr>
            <td><input type='submit' name='$qid[0]' value='submit'/></td>
       </tr>
       <tr>
            <td><a href='sell.php?var=$qid[0]'><input type='button' value='sell'/></a></td>
       </tr>
       </table></form></body></html>";
    }
}
?>

<script>
    func(x)
</script>
