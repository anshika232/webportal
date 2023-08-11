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
   
    $courseid = mysqli_real_escape_string($con,$_POST['course_id']);
    $sqll = "select * from all_courses where course_id = '$courseid'";
    $ql = mysqli_query($con , $sqll);
    $c = mysqli_num_rows($ql);
    if($c == 0){
    $coursename = mysqli_real_escape_string($con,$_POST['course_name']);
    
    $dept = mysqli_real_escape_string($con,$_POST['dept']);
    $credits = mysqli_real_escape_string($con,$_POST['credits']);

   
    $sql = "insert into all_courses(course_id,course_name, dept, credits) 
    values ('$courseid','$coursename','$dept','$credits')";

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
        alert("course id is already present");
    </script>
    <?php
}
}
?>

<div class="login">
          
          <form class="admlogin" action = ""  method = "POST">
              <h3>Add Course</h3>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Course Id</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name = "course_id" required>
                
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Course Name</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name = "course_name" required>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Department</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name = "dept" required>
              </div>
                <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Credits</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name = "credits" required>
              </div>
                
                 
                
                
              
            
              
             
              
              
              <button type="submit" name = "submit" class="btn btn-primary">Submit</button>
            </form>
     
            <a href="dashboard.php">back to dashboard</a>;
  </div>
<div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>  
</body>
</html>