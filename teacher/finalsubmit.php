<?php
include '../connection.php';
$id = $_GET['id'];
$semid = $_GET['semid'];
$branch = $_GET['branch'];

$sql1 = "INSERT INTO `finalsubmit`(`course_id`, `sem_id`, `branch`) VALUES ('$id','$semid','$branch')";
$sql2 = "select * from finalsubmit where course_id = '$id' and sem_id = '$semid' and branch = '$branch'";
$q2 = mysqli_query($con , $sql2);
$c2 = mysqli_num_rows($q2);
if($c2 == 0){
$q1 = mysqli_query($con ,  $sql1);
if($q1){
     echo '<script>alert("marks for this course are finally submitted")</script>';
   
}
else{
    echo '<script>alert("Some Error happened")</script>';
}
}

echo '<a href="dashboard.php">Back to Dashboard</a>';
?>