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
   <a class="nav-link active" id="home-tab" data-toggle="tab" href="profile.php" role="tab" aria-controls="home" aria-selected="true">Profile</a>
 </li>
 <li class="nav-item">
   <a class="nav-link" id="profiile-tab" data-toggle="tab" href="transcript.php" role="tab" aria-controls="profiile" aria-selected="false">Generate Transcript</a>
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
$sql1 = "select * from students where reg_no = '$_SESSION[reg_no]'";
$q1 = mysqli_query($con , $sql1);
$r1 = mysqli_fetch_assoc($q1);
$sql2 = "select sem from semester where prgm = '$r1[programme]' and batch = '$r1[batch]' order by sem desc limit 1";
$q2 = mysqli_query($con , $sql2);
$r2 = mysqli_fetch_assoc($q2);
echo 
"<div>
  </br>
  </br>
  <h4>Name: $r1[name]  </h4>
  </br>
  <h4>Regno: $r1[reg_no] </h4>
  </br>
  <h4>Email: $r1[email]</h4>
  </br>
  <h4>programme:$r1[programme]</h4>
  </br>
  <h4>Batch: $r1[batch]</h4>
  </br>
  <h4>Branch:$r1[branch]</h4>
  </br>
  <h4>Current sem: $r2[sem]</h4>
</div>";
?>
</body>
</html>