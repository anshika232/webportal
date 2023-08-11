<?php
session_start();
if(!isset($_SESSION['name']) && $_SESSION['emp_no']){
    header('location:../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Document</title>
</head>
<style>
    .menu{
       margin : 15px 10px;
    }
    </style>
<body>
    <!-- <div>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
    </div> -->
    <?php
     include '../connection.php';
     $teacherid = $_SESSION['emp_no'];
     $ct = 3;
     $prgm = "B.tech.";
     while($ct != 0){
     if($ct == 1){
      $prgm = "MCA";
     }
     $sql1 = "select distinct batch from semester where prgm ='$prgm'";
     $q1 = mysqli_query($con , $sql1);
     
     
     while($r1 = mysqli_fetch_assoc($q1)){
     $batch = $r1['batch'];
     $s = "SELECT * FROM semester  WHERE  `prgm` = '$prgm'and `batch` = '$batch' order by sem desc limit 1";
     $q = mysqli_query($con , $s);
     $row = mysqli_fetch_assoc($q);
     $semm = $row['sem'];
     $sno = $row['S.no.'];
     $prgm = $row['prgm'];
     $batch = $row['batch'];
     $sql = "SELECT * FROM `courses` WHERE `teacherid` = '$teacherid' and semid = '$sno'";
     $query = mysqli_query($con , $sql);
     $ctt = mysqli_num_rows($query);
     
   
     if($ctt > 0){
      foreach($query as $data){
        
        $id= $data['course_id'];
        $branch = $data['branch'];
        
          $url_back = 'marks.php?';
          $query='id='.$id.'&prgm='.$prgm.'&semid='.$sno.'&batch='.$batch.'&branch='.$branch;
          $url = $url_back.$query;
          // echo 'Look how this url shows up: '.$url;
          echo '<a href="'.$url.'" class="menu btn btn-primary btn-lg active"  role="button" aria-pressed="true">'.$id.' '.$prgm.' '.$batch.' '.$semm.'</a>';
          
        
       
       
       
     
       }
     
     }
    
    }
     $prgm = "M.tech.";
     $ct--;
    }
    

    ?>
    <a href="dashboard.php">back to dashboard</a>;
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>  
</body>
</html>