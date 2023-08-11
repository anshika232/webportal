<?php

include "../connection.php";
$status = 0;
$id = -1;

if(isset($_POST['id'])&& isset($_POST['hit'])){

$id = mysqli_real_escape_string($con , $_POST['id']);
$hit = mysqli_real_escape_string($con , $_POST['hit']);
$sql1 = "select * from `semester` where `S.no.` = '$id'";
$q1 = mysqli_query($con , $sql1);
$r1 = mysqli_fetch_assoc($q1);
$val = $r1['status'];

if($hit == 1){
   if($val == 0){
    $status = 1;
   }
   else if($val == 1){
    $status = 2;
   }
   else if($val == 2){
    $status = 1;
   }
   else if($val == 3){
    $status = 3;
    
   }
   else if($val == 4){
    $status = 4;
   }
   else if($val == 5){
    $status = 5;
    

   }
}
else if($hit == 2){
    if($val == 0){
        $status = 0;
       }
       else if($val == 1){
        $status = 1;
       }
       else if($val == 2){
        $status = 3;
       }
       else if($val == 3){
        $status = 4;
       }
       else if($val == 4){
        $status = 3;
       }
       else if($val == 5){
        $status = 5;
       }
}
else if($hit == 3){
    if($val == 0){
        $status = 0;
       }
       else if($val == 1){
        $status = 1;
       }
       else if($val == 2){
        $status = 2;
       }
       else if($val == 3){
        $status = 3;
       }
       else if($val == 4){
        $status = 5;
       }
       else if($val == 5){
        $status = 5;
       }
}

}
else{
$status = -2;
}
$sql = "update `semester` set `status` = '$status' where `S.no.`= '$id'";

mysqli_query($con , $sql); 

?>