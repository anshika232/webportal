<?php
session_start();
if(!isset($_SESSION['name'])&&!isset($_SESSION['emp_no'])){
    header('location:../index.php');
}

  include '../connection.php';
$id =  $_GET['id'];
$prgm =  $_GET['prgm'];
$semid =  $_GET['semid'];
$batch =  $_GET['batch'];
$branch =  $_GET['branch'];
$sql3 = "SELECT `S.no.`, `sem`, `prgm`, `batch`, `status` FROM `semester` WHERE `S.no.` = $semid order by sem desc limit 1";


$q3 = mysqli_query($con , $sql3);
$r3 = mysqli_fetch_assoc($q3);
$sem = $r3['sem'];
$status = $r3['status'];
$check = 0;

$sql6 = "select * from finalsubmit where course_id = '$id' and sem_id = '$semid' and branch = '$branch'";

$q6 = mysqli_query($con , $sql6);
$c6 = mysqli_num_rows($q6);
if($c6 > 0){
  header("location:fmerror.php");
}
if($status != 3){
  
  echo '<script>alert("marks entry not started for this course yet")</script>';
  // $check = 1;
 
  header("location:merror.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

   
</head>
<style>
    .btm{
        margin: 10px 10px;
    }
    .bar{
        margin:10px 10px;
        width: 240px;
    }
</style>
<!-- <table class="table table-dark table-hover">
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
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table> -->
<body>
 <?php 



$sql1 = "select reg_no , name from students where programme = '$prgm' and batch = '$batch' and branch = '$branch'";
$sql2 = "select type from courses where course_id = '$id' and semid = '$semid' and branch = '$branch'";
$q1 = mysqli_query($con , $sql1);
$q2 = mysqli_query($con , $sql2);

$c1 = mysqli_num_rows($q1);



$r2 = mysqli_fetch_assoc($q2);
$type = $r2['type'];
?>
<table class="table table-striped table-hover" id = "table">
  <thead>
    <tr>
      <th scope="col">reg_no</th>
      <th scope="col">name</th>
      <th scope="col">course ID</th>
      <th scope="col">TA</th>
      <?php
      if($type == 1){
       ?>
      <th scope="col">MID</th>
      <?php
      }
      ?>
      <th scope="col">END</th>
      <th scope="col">TOTAL</th>
    </tr>
  </thead>
  <tbody>
  <?php
  while($r1 = mysqli_fetch_assoc($q1)){
    
    $sql4 = "select * from marks where reg_no = '$r1[reg_no]' and course_id = '$id' and sem = '$sem'";
    $q4 = mysqli_query($con , $sql4);
    $r5 = mysqli_fetch_assoc($q4);
    $ct = mysqli_num_rows($q4);
    if($ct == 0){
    $sql3 = "INSERT INTO `marks`(`reg_no`, `course_id`, `sem`, `TA`, `MID`, `END`, `total`, `grade_point`, `grade`) VALUES ('$r1[reg_no]','$id','$sem','','','','','','')";

    $q3 = mysqli_query($con , $sql3);
    $sql5 = "select * from marks where reg_no = '$r1[reg_no]' and course_id = '$id' and sem = '$sem'";
    $q5 = mysqli_query($con , $sql5);
   
    $r5 = mysqli_fetch_assoc($q5);
    }
    
    
    ?>

    <tr>
      <th scope="row"><?php echo "$r5[reg_no]"?></th>
      <td><?php echo "$r1[name]"?></td>
      <td><?php echo  $id ?></td>
      <td contenteditable = "true" id = "ta"><?php echo "$r5[TA]"?></td>
      
      <?php
      
      if($type == 1){
       ?>
     <td contenteditable = "true" id = "mid" ><?php echo "$r5[MID]"?></td>
      <?php
      }
      ?>
      
      <td contenteditable = "true" id = "end" ><?php echo "$r5[END]"?></td>
      <td contenteditable = "true" id = "total" ><?php echo "$r5[total]"?></td>
    </tr>
    <?php
  }




?>


 
<!-- <a href="dashboard.php" class = "btm">back to dashboard</a> -->
<a href="dashboard.php" class="btm menu btn btn-primary btn-lg active"  role="button" aria-pressed="true">back to dashboard</a>
 
  <button type="button" class="btn btn-primary btn-lg btm" onclick = "updateData()" value = "update">UPDATE MARKS</button>
  <?php
         $url_back = 'finalsubmit.php?';
          $query='id='.$id.'&semid='.$semid.'&branch='.$branch;
          $url = $url_back.$query;
          // echo 'Look how this url shows up: '.$url;
          // 
          echo '<a onclick="someFunction()" href="'.$url.'" class="menu btn btn-primary btn-lg active" role="button" aria-pressed="true">FINAL SUBMIT</a>';
          ?>
  
 <input class="bar form-control mr-sm-2" type="text" id = "myInput" placeholder="Search names" aria-label="Search" onkeyup = "searchname()">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script>

   function updateData(){
    console.log("event fired");
       var table = document.getElementById("table"),rIndex , cIndex;
      
       for(var i = 1; i<table.rows.length; i++){
        var regno = parseInt(table.rows[i].cells[0].innerHTML);
        var courseid = table.rows[i].cells[2].innerHTML;
        var ta = 0;
        ta = parseFloat(table.rows[i].cells[3].innerHTML);
        var mid = parseFloat(0);
        console.log(table.rows[i].cells.length);
        var col = 4;
        if(table.rows[i].cells.length === 7){
        mid =  parseFloat(table.rows[i].cells[4].innerHTML);
        col++;
        }
        var end = 0; 
        end = parseFloat(table.rows[i].cells[col].innerHTML);
        
       
        var total = ta + mid + end;
        

        console.log(ta);
        console.log(mid);
        console.log(end);
        console.log('total ='+ total);
        // console.log(gp);
        // console.log(g);





        var data = 'id='+courseid+'&reg='+regno+'&ta='+ta+'&mid='+mid+'&end='+end+'&total='+total;
        console.log(data);
        
        jQuery.ajax({
            url : 'updatemarks.php',
            type : 'post',
            data: data,
            
            success:function(data , status){
               
               console.log("success");
            }
          

        });
        
       
       }
       
       

       
       
   }
   function someFunction(){
      console.log("Some function hitted..");
      // confirm("Do you really want to finalize these marks?");
   }
   function searchname(){
          let filter = document.getElementById('myInput').value.toUpperCase();
          let table = document.getElementById('table');
          let tr = table.getElementsByTagName('tr');
            for(var i = 0; i<tr.length; i++){
                let td = tr[i].getElementsByTagName('td')[0];
                if(td){
                    let textvalue = td.textContent || td.innerHTML;
                    if(textvalue.toUpperCase().indexOf(filter) > -1){
                        tr[i].style.display = "";
                    }
                    else{
                        tr[i].style.display = "none";
                    }
                }
            }

   }
    </script>
   
    
</body>
</html>