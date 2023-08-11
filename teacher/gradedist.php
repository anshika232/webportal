<?php
session_start();
if(!isset($_SESSION['name']) && !isset($_SESSION['emp_no'])){
    header('location:../index.php');
}
$prgm = $_GET['prgm'];
$batch = $_GET['batch'];
echo $prgm;
echo "<br>";
echo $batch;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<style>
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
       width: 30%;
       display: flex;
       align-content: center;
       flex-direction: column;
       align-self: center;
    }
    .admlogin h3{
      font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
      align-self: center;
    }
    .admlogin .btn{
        width: 40%;
    }
</style>
<body>
<?php
include '../connection.php';
if(isset($_POST['submit'])){
    $midsem = 0;
    $courseid = mysqli_real_escape_string($con,$_POST['course_id']);
    $sqll = "select * from all_courses where course_id = '$courseid'";
    $ql = mysqli_query($con , $sqll);
    $c1 = mysqli_num_rows($ql);

    if($c1 > 0){
    $coursename = mysqli_real_escape_string($con,$_POST['course_name']);
    
    $type = mysqli_real_escape_string($con,$_POST['type']);
    $ta = mysqli_real_escape_string($con,$_POST['ta']);

    if($type == 1){
    $midsem = mysqli_real_escape_string($con,$_POST['mid_sem']);
    }
    $endsem = mysqli_real_escape_string($con,$_POST['end_sem']);
    $branch = mysqli_real_escape_string($con,$_POST['branch']);

    $teacherid = $_SESSION['emp_no'];
    $sql2 = "select * from semester where prgm = '$prgm' and batch = '$batch' order by sem desc limit 1";

    $q2 = mysqli_query($con, $sql2);
    $r2 = mysqli_fetch_assoc($q2);
    $semid = $r2['S.no.'];
    
    $sql3 = "select * from courses where course_id = '$courseid' and semid = '$semid' and branch = '$branch' and teacherid = '$teacherid'";
    $q3 = mysqli_query($con , $sql3);
    $c3 = mysqli_num_rows($q3);
   
    if($c3 == 0){
    
    $sql = "insert into courses(course_id,type, ta, mid_sem, end_sem,semid,branch,teacherid) 
    values ('$courseid','$type','$ta','$midsem','$endsem','$semid','$branch','$teacherid')";
    
    $query = mysqli_query($con , $sql);
   
    if($query){
        ?>
        <script>
            alert("course added successfully");
        </script>
        <?php
    }
    else{
        ?>
        <script>
            alert("failed to add course");
        </script>
        <?php
    }
  }
  else{
    ?>
    <script>
        alert("course is already added");
    </script>
    <?php
  }
  }
  else{
    ?>
    <script>
        alert("course not found");
    </script>
    <?php
}
}
?>

<div class="login">
          
          <form class="admlogin" action = ""  method = "POST">
              <h3>Couse Entry</h3>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Course Id</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name = "course_id" required>
                
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Course Name</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name = "course_name" required>
              </div>
              <label class="my-1 mr-2" for="dropdown" >Type</label>
                <select class="custom-select my-1 mr-sm-2" id='dropdown' onchange="change_attributes(this.form)" name = "type" required>
                  
                    <option value="1" >Theory</option>
                    <option value="2" >Lab</option>
                
                </select>
                <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">TA Marks</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name = "ta" required>
              </div>
                
                 <div class="mb-3" id = "midsem">
                    <label for="exampleInputPassword1" class="form-label">Mid Sem Marks</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name = "mid_sem">
                 </div>

                
                
              
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">End Sem Marks</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name = "end_sem" required>
              </div>
              
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Branch</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name = "branch" required>
              </div>
              
              
              <button type="submit" name = "submit" class="btn btn-primary">Submit</button>
            </form>
     
            <a href="dashboard.php">back to dashboard</a>;
  </div>
<div>
<script>
function change_attributes(myform){
    if(myform.dropdown.selectedIndex === 1){
      $('#midsem').hide()
    }else{
        $('#midsem').show();
    }
 }  
</script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>  
</body>
</html>