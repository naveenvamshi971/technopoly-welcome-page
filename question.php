
<?php
/**
 * Created by PhpStorm.
 * User: Chanakya
 * Date: 9/16/2018
 * Time: 12:32 PM
 */
session_start();
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
$balance=$r4['balance'];

$sq5="select * from question where qid='$qid[0]' and status!=1 ;";
if(($r5=$conn->query($sq5))== false)
    echo $conn->error;
else{
    if($r5->num_rows){

    }
    else{
        header('Refresh:0; url=index1.html');
        echo '<script language="javascript">';
        echo 'alert("Too slow....Try other qustion")';
        echo '</script>';
    }
}
$sql="select * from question where qid='$qid[0]';";
$sq2="select * from options where qid='$qid[0]';";
if(($i1=$conn->query($sql))== false or ($i2=$conn->query($sq2))== false)
{
    echo $conn->error;
}
else {
    $cp=1;
    while($r1 = $i1->fetch_assoc())
    {
        if($balance>=$r1['price']) {
            $ques = $r1['question'];
            $cp=$r1['price'];
            $x = $qid[0];
            break;
        }
        else{
            header('Refresh:0; url=index1.html');
            echo '<script language="javascript">';
            echo 'alert("insufficint balance")';
            echo '</script>';
        }
    }

    $bal=$r4['balance'];
    #echo $bal;
    #echo $cp."bye";
    #echo "hii";
    $sq7="select * from market where qid='$qid[0]'";
    if(($i7=$conn->query($sq7))== false)
    {
        echo $conn->error;
    }
    else{
        if($i7->num_rows){
            while($r7=$i7->fetch_assoc()){
                break;
            }
            $uidnew=$r7['uid'];
            $sq8="update login set balance=balance+'$cp' where uid=$uidnew";
            if(($i8=$conn->query($sq8))== false)
            {
                echo $conn->error;
            }
    }
    }
    $sq3="update login set balance='$bal'-'$cp' where uname='$uname';";

    if(($i3=$conn->query($sq3))== false)
    {
        echo $conn->error;
    }
    $sq6="update question
              set status=1
              where qid='$qid[0]'";
    if(($i6=$conn->query($sq6))== false)
    {
        echo $conn->error;
    }
    while($r2 = $i2->fetch_assoc()){
        $option1=$r2['option-1'];
        $option2=$r2['option-2'];
        $option3=$r2['option-3'];
        $option4=$r2['option-4'];
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        history.pushState(null, null, location.href);
        window.onpopstate = function ()
        {
            history.go(1);
        };
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login to Technopoly</title>
    <link rel="stylesheet" href="bootstrap-4.0.0-alpha.6-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-4.0.0-alpha.6-dist/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="login.css">
</head>
<body class="question-body">
<div class="container question-container">
    <div class="row">
        <div class="col"></div>
        <div class="col-sm-12 col-md-8">
            <div class="card question-card">
                <div class="card-block question-block">

                    <div>
                        <label for="question"> <font size="+2"><?php echo $x ?>.<?php echo $ques ?></font></label>
                    </div><br><br>
                    <form action="check.php" method="POST">
                        <div>
                            <label class="btn btn-lg btn-secondary signin-button">
                                <input type='radio' name='option' value='1'><?php echo $option1 ?>
                            </label>
                            <label class="btn btn-lg btn-secondary signin-button">
                                <input type='radio' name='option' value='2'><?php echo $option2 ?>
                            </label>
                            <label class="btn btn-lg btn-secondary signin-button">
                                <input type='radio' name='option' value='3'><?php echo $option3 ?>
                            </label>
                            <label class="btn btn-lg btn-secondary signin-button">
                                <input type='radio' name='option' value='4'><?php echo $option4 ?>
                            </label> <br> <br>

                            <input class="btn btn-lg btn-secondary question-btn " type='submit' name="<?php echo $qid[0] ?>" value='submit'/>
                    </form>
                            <a href='sell.php?var=<?php echo $qid[0] ?>'><input type="button" class="btn btn-lg btn-secondary question-btn " value="Sell"></></a>


                        </div>

                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>
</div>


</body>
</html>


