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
    border: 2px solid black;
    margin: 15px 15px;
    padding: 13px 10px;
    width: 500px;

  }
  .tablecard{
   
    border: 2px solid black;
    margin: 15px 15px;
    padding: 13px 10px;
    width: 1000px;

  }
  </style>
<body>
<body>

<div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
   <?php 
    echo $_SESSION['name'];
    ?>
  </a>
   
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
  <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
  
  <div>

</div>
 

    
  </ul>
<ul class="nav nav-tabs " id="myTab" role="tablist">
 
 <li class="nav-item">
   <a class="nav-link" id="home-tab" data-toggle="tab" href="profile.php" role="tab" aria-controls="home" aria-selected="true">Profile</a>
 </li>
 <li class="nav-item">
   <a class="nav-link" id="profiile-tab" data-toggle="tab" href="transcript.php" role="tab" aria-controls="profiile" aria-selected="false">Generate Transcript</a>
 </li>
 <li class="nav-item">
   <a class="nav-link " id="messages-tab" data-toggle="tab" href="result.php" role="tab" aria-controls="messages" aria-selected="false">Result</a>
 </li>
 <li class="nav-item">
   <a class="nav-link  active" id="settings-tab" data-toggle="tab" href="allcourses.php" role="tab" aria-controls="settings" aria-selected="false">All registered Courses</a>
 </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
 
 <div class="tab-pane " id="home" role="tabpanel" aria-labelledby="home-tab"></div>
 <div class="tab-pane " id="profiile" role="tabpanel" aria-labelledby="profiile-tab"></div>
 <div class="tab-pane " id="messages" role="tabpanel" aria-labelledby="messages-tab"></div>
 <div class="tab-pane " id="settings" role="tabpanel" aria-labelledby="settings-tab"></div>


 
</div>
<div>

<?php
  require '../connection.php';
  $regno = $_SESSION['reg_no'];
  $sql1 = "select branch , batch , programme from students where reg_no = '$regno'";
  $q1 = mysqli_query($con , $sql1);
  $r1 = mysqli_fetch_assoc($q1);
  $branch = $r1['branch'];
  $batch = $r1['batch'];
  $prgm = $r1['programme'];
  $sql2 = "select * from semester where prgm = '$prgm' and batch = '$batch' order by sem desc limit 1";
  $q2 = mysqli_query($con , $sql2);
  $r2 = mysqli_fetch_assoc($q2);
  $sno = $r2['S.no.'];
  $sql3 = "select course_id , teacherid from courses where semid = '$sno' and branch = '$branch'";
  $q3 = mysqli_query($con , $sql3);
  $ct = mysqli_num_rows($q3);

  if($ct > 0){
    ?>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">CourseID</th>
      <th scope="col">Name</th>
      <th scope="col">Credits</th>
      <th scope="col">Assigned Faculty</th>
    </tr>
  </thead>

    <tbody>
        <?php
  while($data = mysqli_fetch_assoc($q3)){
    $sql4 = "select * from all_courses where course_id = '$data[course_id]'";
    $q4 = mysqli_query($con , $sql4);
    $r4 = mysqli_fetch_assoc($q4);
    $sql5 = "select * from teachers where emp_no = '$data[teacherid]'";
    $q5 = mysqli_query($con , $sql5);
    $r5 = mysqli_fetch_assoc($q5);
    $coursename = $r4['course_name'];
    $credits = $r4['credits'];
    $teachername = $r5['name'];
   ?>
<tr>
  <th scope="row"><?php echo "$data[course_id]"?></th>
  <td><?php echo $coursename ?></td>
  <td><?php echo $credits?></td>
  <td><?php echo $teachername?></td>
</tr>
   
<?php
 }
?>
 <tbody>
    <?php
 }

?>


</div>
</body>
</html>