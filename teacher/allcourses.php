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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<table class="table">
  <thead>
    <tr>
      <th scope="col">CourseID</th>
      <th scope="col">Name</th>
      <th scope="col">Programme</th>
    </tr>
  </thead>
<?php
     include '../connection.php';
     $teacherid = $_SESSION['emp_no'];
     $sql2 = "select dept from teachers where emp_no = '$teacherid'";
     $q2 = mysqli_query($con , $sql2);
     $r2 = mysqli_fetch_assoc($q2);
     $dept = $r2['dept'];
     $sql = "SELECT * FROM `all_courses`where dept = '$dept'";
     $query = mysqli_query($con , $sql);
     $ct = mysqli_num_rows($query);
    
   
    
     if($ct > 0){
        ?>
        <tbody>
            <?php
      while($data = mysqli_fetch_assoc($query)){
       ?>
    <tr>
      <th scope="row"><?php echo "$data[course_id]"?></th>
      <td><?php echo "$data[course_name]"?></td>
      <td><?php echo "$data[dept]"?></td>
      
    </tr>
       
    <?php
     }
    ?>
     <tbody>
        <?php
     }

    ?>
    <a href="dashboard.php">back to dashboard</a>
</body>
</html>