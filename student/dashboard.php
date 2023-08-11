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
  .boxmed{
    width: 1000px;
    height: 900px;
  }
  </style>
<body>
<div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
   <?php 
    include '../connection.php';
    echo $_SESSION['name'];
    

    
    ?>
  </a>
   
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
  <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
  
  <div>

</div>
 

    
  </ul>

  <!-- Nav tabs -->
<ul class="nav nav-tabs " id="myTab" role="tablist">
 
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="profile.php" role="tab" aria-controls="home" aria-selected="true">Profile</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profiile-tab" data-toggle="tab" href="transcript.php" role="tab" aria-controls="profiile" aria-selected="false">Generate Transcript</a>
  </li>
  
  <li class="nav-item">
    <a class="nav-link" id="messages-tab" data-toggle="tab" href="result.php" role="tab" aria-controls="messages" aria-selected="false">Result</a>
  </li>
  
  <li class="nav-item">
    <a class="nav-link" id="settings-tab" data-toggle="tab" href="allcourses.php" role="tab" aria-controls="settings" aria-selected="false">All registered Courses</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  
  <div class="tab-pane " id="home" role="tabpanel" aria-labelledby="home-tab"></div>
  <div class="tab-pane " id="profiile" role="tabpanel" aria-labelledby="profiile-tab"></div>
  <div class="tab-pane " id="messages" role="tabpanel" aria-labelledby="messages-tab"></div>
  <div class="tab-pane " id="settings" role="tabpanel" aria-labelledby="settings-tab"></div>


  
</div>
<!-- <a href="result.php" class="menu btn btn-primary btn-lg active"  role="button" aria-pressed="true">Result current sem</a>
</div>
<div>
<a href="prevsem.php" class="menu btn btn-primary btn-lg active"  role="button" aria-pressed="true">generate transcript</a>
</div>
<div>
<a href="prevsem.php" class="menu btn btn-primary btn-lg active"  role="button" aria-pressed="true">prev semester performance</a>
</div>
<div>
<a href="allcourses.php" class="menu btn btn-primary btn-lg active"  role="button" aria-pressed="true">View registered Courses</a> -->
</body>
</html>