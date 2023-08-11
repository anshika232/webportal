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
   
    $p = mysqli_real_escape_string($con,$_POST['prgm']);
    
    $batch = mysqli_real_escape_string($con,$_POST['batch']);
    $prgm = "B.tech.";
    if($p == 2){
        $prgm = "M.tech.";
    }
    else if($p == 3){
        $prgm = "MCA";
    }
    echo $prgm;
    $sqll = "select * from semester where prgm = '$prgm' and batch = '$batch'";
    $ql = mysqli_query($con , $sqll);
    $c = mysqli_num_rows($ql);
    $status = 0;
    $sem = 1;
    if($c == 0){
    
    
   
    $sql = "INSERT INTO `semester`( `sem`, `prgm`, `batch`, `status`) VALUES ('$sem' ,'$prgm','$batch','$status')";

    $query = mysqli_query($con , $sql);
    if($query){
        ?>
        <script>
            alert("semester added successfully");
        </script>
        <?php
    }
    else{
        ?>
        <script>
            alert("failed to add semester");
        </script>
        <?php
    }
  }
  else{

    $sql2 = "select * from semester where prgm = '$prgm' and batch = '$batch' order by sem desc limit 1";
    $q2 = mysqli_query($con , $sql2);
    $r = mysqli_fetch_assoc($q2);
         $status = $r['status'];
         $sem = $r['sem'];
         $sno = $r['S.no.'];
         if($status == 5){
         if($prgm == "B.tech." && $sem != 8){
            $sem++;
         }
           else if($prgm == "M.tech." && $sem != 4){
            $sem++; 
           }
              
            else if($prgm == "MCA" && $sem != 6){
            $sem++;
             
            }
         $sql2 = "INSERT INTO `semester`( `sem`, `prgm`, `batch`, `status`) VALUES ('$sem' ,'$prgm','$batch',0)";
         $q2 = mysqli_query($con , $sql2);
         if($q2){
            ?>
            <script>
                alert("semester added successfully");
            </script>
            <?php
        }
        else{
            ?>
            <script>
                alert("failed to add semester");
            </script>
            <?php
        }

    }
}
}
?>

<div class="login">
          
          <form class="admlogin" action = ""  method = "POST">
              <h3>Change Sem</h3>
              <div class="mb-3">
              <label class="my-1 mr-2" for="dropdown" >programme</label>
                <select class="custom-select my-1 mr-sm-2" id='dropdown'  name = "prgm" required>
                  
                    <option value="1" >B.tech.</option>
                    <option value="2" >M.tech</option>
                    <option value="3" >MCA</option>
                    
                
                </select>
                
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Batch</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name = "batch" required>
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