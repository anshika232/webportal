<?php
session_start();
if(!isset($_SESSION['name']) || !isset( $_SESSION['reg_no'])){
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<style>
  .menu{
    margin: 15px 15px;
    padding: 13px 13px;
    width: 300px;
    display: flex;
    flex-direction: row;
    height: 100vh;

  }
  
  .card{
    display: flex;
    flex-direction: column;
    /* border: 2px solid black; */
    margin: 5px 5px;
    padding: 3px 3px;
    width: 200px;

  }
  .tablecard{
   
    /* border: 2px solid black; */
    margin: 15px 15px;
    padding: 13px 10px;
    width: 700px;

  }
  .tablebox{
   
   border: 2px solid black;
   margin: 15px 15px;
   padding: 13px 10px;
   width: 800px;

 }
  </style>

<body>
<div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
   <?php 
    echo $_SESSION['name'];
    ?>
  </a>
   
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
  <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
  
  

</div>
 

    
  </ul>
<ul class="nav nav-tabs " id="myTab" role="tablist">
 
 <li class="nav-item">
   <a class="nav-link" id="home-tab" data-toggle="tab" href="profile.php" role="tab" aria-controls="home" aria-selected="true">Profile</a>
 </li>
 <li class="nav-item">
   <a class="nav-link active" id="profiile-tab" data-toggle="tab" href="transcript.php" role="tab" aria-controls="profiile" aria-selected="false">Generate Transcript</a>
 </li>
 <li class="nav-item">
   <a class="nav-link " id="messages-tab" data-toggle="tab" href="result.php" role="tab" aria-controls="messages" aria-selected="false">Result</a>
 </li>
 <li class="nav-item">
   <a class="nav-link " id="settings-tab" data-toggle="tab" href="allcourses.php" role="tab" aria-controls="settings" aria-selected="false">All registered Courses</a>
 </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
 
 <div class="tab-pane " id="home" role="tabpanel" aria-labelledby="home-tab"></div>
 <div class="tab-pane " id="profiile" role="tabpanel" aria-labelledby="profiile-tab"></div>
 <div class="tab-pane " id="messages" role="tabpanel" aria-labelledby="messages-tab"></div>
 <div class="tab-pane " id="settings" role="tabpanel" aria-labelledby="settings-tab"></div>


 
</div>

   <?php 
      include '../connection.php';
      $regno = $_SESSION['reg_no'];
      $sql1 = "select * from students where reg_no = '$regno'";
      $q1 = mysqli_query($con , $sql1);
      $c1 = mysqli_num_rows($q1);

      $r1 = mysqli_fetch_assoc($q1);
     $prgm = $r1['programme']; 
     $batch = $r1['batch'];  
    // modify sql2 when you modify database table students

    $sql2 = "select * from semester where prgm = '$prgm' and batch = '$batch'order by sem desc limit 1";
    $q2 = mysqli_query($con , $sql2);
    $r2 = mysqli_fetch_assoc($q2);
    $sem = $r2['sem'];
    $status = $r2['status'];
    $asem = $sem;
    $ct = $sem;
    if($status == 5){
      $ct = $ct + 1;
    }
    $sem = 1;
    $acd = 0;

    while($sem != $ct){
       
        $sql3 = "select * from marks where reg_no ='$_SESSION[reg_no]' and sem = '$sem'";
        $q3 = mysqli_query($con, $sql3);
        $c3 = mysqli_num_rows($q3);
        if($c3 > 0){
        ?>
    
    <div class = "tablebox ">
    <!-- table table-striped table-hover -->
    <table class="tablecard border = 0.2 table-hover" id = "table">
      <thead>
        <tr>
          <th scope="col">S.no</th>
          <th scope="col">course ID</th>
          <th scope="col">course name</th>
          <th scope="col">Grade point</th>
          <th scope="col">Grade</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $num = 0;
      $spi = 0;
      $sum = 0;
        while($r3 = mysqli_fetch_assoc($q3)){
            $num++;
    
        $sql4 = "select * from all_courses where course_id = '$r3[course_id]'";
        $q4 = mysqli_query($con , $sql4);
        $r4 = mysqli_fetch_assoc($q4);
        $credit = $r4['credits'];
        $gp = $r3['grade_point'];
        $spi += ($gp * $credit);
        $sum += $credit;
        if($r3['grade'] == 'E' || $r3['grade'] == 'F'){
          $acd = 1;
        }
       
        ?>
    
      <tr>
      <th scope="row"><?php echo $num ?></th>
    
      
    
      <td><?php echo "$r3[course_id]"?></td>
      <td><?php echo "$r4[course_name]"?></td>
      <td><?php echo "$r3[grade_point]"?></td>
      <td><?php echo "$r3[grade]"?></td>
      
    </tr>
    
    <?php
       
        }
        ?>
        <?php
     
     if($sum > 0){
      $spi = $spi/$sum;
     }
      $pcpi = 0;
     
      $semm = $sem-1;
      $sql5 = "SELECT SUM(spi) AS 'pspi'   
      FROM spi_cpi  
      WHERE reg_no = '$regno' and sem < $sem";
      $q5 = mysqli_query($con , $sql5);
      $r5 = mysqli_fetch_assoc($q5);
      // echo $r5['pspi'];
      $pspi = $r5['pspi'] + $spi;
      $cpi = $pspi/$sem;

     
     if($spi < 5 || $cpi < 5){
      $acd = 1;
     }

     $sql8 = "select cpi from spi_cpi where reg_no = '$regno' and sem = '$sem'";
     $q8 = mysqli_query($con , $sql8);
     $c8 = mysqli_num_rows($q8);
     if($c8 == 0 && $sem == $asem){
     $sql6 = "INSERT INTO `spi_cpi`(`reg_no`, `sem`, `spi`, `cpi`) VALUES ('$regno','$sem','$spi','$cpi')";
     $q6 = mysqli_query($con , $sql6);

     }
     else if( $sem == $asem){
        $sql6 = "UPDATE `spi_cpi` SET `reg_no`='$regno',`sem`='$sem',`spi`='$spi',`cpi`='$cpi' WHERE  reg_no = '$regno' and sem = '$sem' ";
        $q6 = mysqli_query($con , $sql6);
     }
     ?>
     <div class = "card">
 <p>sem : <?php echo $sem?></p>
 <p>SPI : <?php echo $spi ?> </p>
 <p>CPI : <?php echo $cpi ?> </p>
    </div>
        </tbody>
       
 


    </table>
    </div>
    <?php
    
    }
    $sem++;
    }
    ?>
    <p>Status : <?php 
    $var = $asem - 1;
    if($status == 5)
    $var++;

if($acd == 0){
echo "Passed till $var sem";
}
else{
  echo "Academic Deficient";
} ?> </p>
   
   


   


</body>
</html>