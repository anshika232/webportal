<?php

include "../connection.php";
if(isset($_POST['id'])&& isset($_POST['reg']) && isset($_POST['ta']) && isset($_POST['mid']) && isset($_POST['end']) && isset($_POST['total'])){

$id = mysqli_real_escape_string($con , $_POST['id']);
$reg = mysqli_real_escape_string($con , $_POST['reg']);
$ta = mysqli_real_escape_string($con , $_POST['ta']);
$mid = mysqli_real_escape_string($con , $_POST['mid']);
$end = mysqli_real_escape_string($con , $_POST['end']);
$total = mysqli_real_escape_string($con , $_POST['total']);
$gp = 10;
$g = "A+";

if($total <= 84 && $total >=75){
    $gp = 9;
    $g = "A";
}
else if($total <= 74 && $total >=65){
    $gp = 8;
    $g = "B+";
}
else if($total <= 64 && $total >=55){
    $gp = 7;
    $g = "B";
}
else if($total <= 54 && $total >=45){
    $gp = 6;
    $g = "C";
}
else if($total <= 44 && $total >=30){
    $gp = 4;
    $g = "D";
}
else if($total <= 29 && $total >=15){
    $gp = 2;
    $g = "E";
}
else if($total < 15){
    $gp = 0;
    $g = "F";
}
$sql = "update marks set TA = '$ta', MID = '$mid' , END = '$end', total = '$total', grade_point = '$gp', grade = '$g' where reg_no = '$reg' and course_id = '$id'";

mysqli_query($con , $sql);
 

}
  

?>