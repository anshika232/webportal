<?php

session_start();
if(!isset($_SESSION['name']) && !isset($_SESSION['emp_no'])){
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
  body{
    background-image: url(../mnnit.jpg);
   background-repeat: no-repeat;
   background-size: 100%;
  }
  #dashb{
    display: flex;
   flex-direction: column;
   align-items: center;
   align-content: center;
  margin-top: 90px;
  }
  .menu{
    margin: 15px 15px;
    padding: 15px 20px;
    width:300px;
  }

    *{
        margin : 0;
        padding: 0;
        
        
    }
    .login{
        display: flex;
        flex-direction: column;
        align-items:center;
        
    }
    .admlogin{
       margin : 10px 10px 10px 10px;
       width: 20%;
       height: 40vh;
       position:absolute;
       left: 40%;
       top:20%;
       background-color: rgb(245, 241, 241);
       flex-direction: column;


       align-items: center;
       
       
    }
    
    .admlogin h3{
      font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
      align-self: center;
    }
    .admlogin .btn{
        width: 100px;
        margin: auto;
    }
    .sel{
      width: 290px;
      margin-top: 30px;
      margin-left: 5px;
      margin-right: 5px;
      padding: 10px 10px;
    }
    .lab{
      margin-left: 5px;
      margin-top: 10px;
      color: black;
    }

  </style>

<body>
  <?php
   require '../connection.php';
   $prgm = "B.tech.";
   $batch = 20;
   if(isset($_POST['submit'])){
    
  $type = mysqli_real_escape_string($con , $_POST['prgm']);
  if($type == 2){
    $prgm = "M.tech.";
  }
  else if($type == 3){
    $prgm = "MCA";
  }
    if(isset($_POST['batch']))
    $batch = mysqli_real_escape_string($con , $_POST['batch']);
    echo $prgm;
    echo $batch;
    $sql1 = "select * from semester where prgm = '$prgm' and batch = '$batch' order by sem desc limit 1";
    $q1 = mysqli_query($con , $sql1);
    $c1 = mysqli_num_rows($q1);
    if($c1 > 0){
      $r1 = mysqli_fetch_assoc($q1);
      $status = $r1['status'];
      $sem = $r1['sem'];
       echo $status;
       echo $sem;
      if($status == 1){
        $url_back = 'gradedist.php?&prgm='.$prgm.'&batch='.$batch;
          $query='&prgm=';
          $url = $url_back.$query;
          echo 'Look how this url shows up: '.$url;
          
          
        header('location:gradedist.php?&prgm='.$prgm.'&batch='.$batch);
      }
      else{
        ?>
        <script>
          alert("Course Entry is not Started yet");
        </script>
        <?php
      }
    }
   

   }
  ?>

<div class="dropdown">
  <a class="menu btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
    <?php 
    echo $_SESSION['name'];
    ?>
  </a>

  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
  
  </ul>
   
</div>

<div id = 'dashb'>
<div>
<!-- <a href="" id = "btn1" class="menu btn btn-primary btn-lg active"  role="button" aria-pressed="true">Enter Marks Distribution</a> -->
<button type="button" id = "btn1"class="menu btn btn-primary btn-lg btm">Enter Marks Distribution</button>

</div>
<div>

<a href="marksentry.php" class="menu btn btn-primary btn-lg active" role="button" aria-pressed="true">Enter Marks </a>
</div>
<div>
<a href="allcourses.php" class="menu btn btn-primary btn-lg active" role="button" aria-pressed="true">View All Courses</a>
</div>
</div>
<div id = "popup">

<form class="admlogin" action = ""  method = "POST">
              
              

                
                
              
              
              <div class="mb-3">
                <label for="prog" class="lab form-label">programme</label>
                <select class="custom-select my-1 mr-sm-2 sel" id='prog' name = "prgm" required>
                  
                    <option value="1" >B.tech.</option>
                    <option value="2" >M.tech.</option>
                    <option value="3" >MCA</option>
                
                </select>
              </div>
              
              <div class="mb-3" id = "btch">
              <label class="lab my-1 mr-2" for="dropdown" >Batch</label>
                <select class="custom-select my-1 mr-sm-2 sel" id='dropdown' name = "batch" required>
                  <?php
                   $sql1 = "select * from semester";
                   $q1 = mysqli_query($con , $sql1);
                   while($r1 = mysqli_fetch_assoc($q1))
                   {
                     $batch = $r1['batch'];
                    echo "<option value=$batch >$batch</option>";
                
                 
                   }
                   ?>
                </select>
              </div>
              
              
              
              <button type="submit" name = "submit" class="btn btn-primary">Submit</button>
            </form>

   
     
</div>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script>
$(document).ready(function () {
  $("#popup").hide();
    $("#btn1").click(function () {
        $("#popup").show();
    });
   
});
</script>
</body>
</html>