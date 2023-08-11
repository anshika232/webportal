<?php
session_start();
if(!isset($_SESSION['id'])){
    header('location:../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

     include '../connection.php';
     $prgm = "B.tech.";
     $ct = 3;
     ?>
     <table class="table">
   <thead>
     <tr>
       <th scope="col">TeacherID</th>
       <th scope="col">TeacherName</th>
       <th scope="col">Phone Number</th>
       <th scope="col">CourseID</th>
       <th scope="col">Programme</th>
       <th scope="col">Batch</th>
       <th scope="col">Branch</th>
     </tr>
   </thead>
 
     <tbody>
         <?php
     while($ct != 0){
        
        
        if($ct == 1){
            $prgm = "MCA";
        }

        $sql1 = "select distinct batch from semester where prgm ='$prgm'";
        $q1 = mysqli_query($con , $sql1);
        $c1 = mysqli_num_rows($q1);
        
        if($c1 > 0){
          while($r1 = mysqli_fetch_assoc($q1)){
            
            $batch =  $r1['batch'];

            $sql2 = "select * from semester where prgm ='$prgm' and batch = '$batch' order by sem desc limit 1";
            $q2 = mysqli_query($con , $sql2);
            $r2 = mysqli_fetch_assoc($q2);
            $semid = $r2['S.no.'];
            $status = $r2['status'];

            // echo $semid;
            // echo "</br>";
            if($status == 3){
            $sql3 = "select * from courses where semid = '$semid'";
            $q3 = mysqli_query($con , $sql3);
            $c3 = mysqli_num_rows($q3);
            if($c3 > 0){
              
              while($r3 = mysqli_fetch_assoc($q3)){
                $id =  $r3['course_id'];
                $branch =  $r3['branch'];
                $teacherid = $r3['teacherid'];
                $sql4 = "select * from finalsubmit where sem_id = '$semid' and course_id = '$id' and branch = '$branch'";
                $q4 = mysqli_query($con , $sql4);
                $c4 = mysqli_num_rows($q4);
                if($c4 == 0){

                  $sql5 = "select * from teachers where emp_no = '$teacherid'";
                  $q5 = mysqli_query($con , $sql5);
                  $c5 = mysqli_num_rows($q5);
                  $r5 = mysqli_fetch_assoc($q5);
                  ?>
                  <tr>
                    <th scope="row"><?php echo "$teacherid"?></th>
                    <td><?php echo $r5['name'] ?></td>
                    <td><?php echo $r5['phone']?></td>
                    <td><?php echo $id?></td>
                    <td><?php echo $prgm?></td>
                    <td><?php echo $batch?></td>
                    <td><?php echo $branch?></td>
                  </tr>
                     
                  <?php
                }
              }

            }
          }


          }

        }

      $prgm = "M.tech.";
      $ct--;
    }
     ?>
 <tbody>
    <?php

    ?>
    <div>
    <a href="dashboard.php">Back to dashboard</a>
  </br>
  </br>
    </div>
   

</body>
</html>