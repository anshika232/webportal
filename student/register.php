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
    *{
        margin : 0;
        padding: 0;
        
        
    }
    .register{
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
         $regno = 20190001;
         $name = mysqli_real_escape_string($con,$_POST['name']);
         $email = mysqli_real_escape_string($con,$_POST['email']);
         $dob = mysqli_real_escape_string($con,$_POST['DOB']);
         $prgm = mysqli_real_escape_string($con,$_POST['programme']);
         $batch = mysqli_real_escape_string($con,$_POST['batch']);
         $branch = mysqli_real_escape_string($con,$_POST['branch']);
         $password = mysqli_real_escape_string($con,$_POST['password']);
         $cpassword = mysqli_real_escape_string($con,$_POST['cpassword']);

         if($prgm == "B.tech."){
           $pref = $batch;
         }
         else if($prgm == "M.tech."){
          $b = $batch%2000;
          $pref = $b.'MT';
        }
        else if($prgm == "MCA"){
          $pref = "20CA";
        
        }
        $suff = 1000;
        if($prgm == "B.tech." && $branch == "bt"){
          $suff = 1000;
        }
        else if($prgm == "B.tech." && $branch == "ch"){
          $suff = 2000;
        }
        else if($prgm == "B.tech." && $branch == "civil"){
          $suff = 3000;
        }
        else if($prgm == "B.tech." && $branch == "cs"){
          $suff = 4000;
        }
        else if($prgm == "B.tech." && $branch == "ece"){
          $suff = 5000;
        }
        else if($prgm == "B.tech." && $branch == "ee"){
          $suff = 6000;
        }
        else if($prgm == "B.tech." && $branch == "it"){
          $suff = 8000;
        }
        else if($prgm == "B.tech." && $branch == "me"){
          $suff = 9000;
        }
        else if($prgm == "B.tech." && $branch == "pie"){
          $suff = 7000;
        }
        
         $pass = password_hash($password , PASSWORD_BCRYPT);
         $cpass = password_hash($cpassword , PASSWORD_BCRYPT);

         $email_query = "select * from students where email = '$email'";
         $query = mysqli_query($con , $email_query);
         
         $count = mysqli_num_rows($query);

         if($count > 0){
             echo "Email already exists";

         }
         else{

          if($password == $cpassword){
            $cquery = "select * from students where programme = '$prgm' and batch = '$batch' and branch = '$branch'";
            $cq = mysqli_query($con , $cquery);
            $ct = mysqli_num_rows($cq);
            
        
            if($ct > 0){
                $last_suff = "select suff from students where programme = '$prgm' and batch = '$batch' and branch = '$branch' order by suff desc limit 1";
                $lr = mysqli_query($con , $last_suff);
                $row = mysqli_fetch_assoc($lr);
                $sf = $row["suff"];
                $sf = $sf%$suff;
                $suff = $suff + $sf;          
            
          }
          $suff = $suff + 1;
          echo $suff;
          $regno = $pref.$suff;
          $sql = "insert into students(reg_no,name, DOB, email, programme,batch,branch,suff,password, cpassword) 
          values('$regno', '$name', '$dob' , '$email' , '$prgm' ,'$batch' ,'$branch','$suff', '$pass' , '$cpass')";
          
             //     if ($con->query($sql) === TRUE) {
             //         echo "New record created successfully";
             //     } else {
             //         echo "Error: " . $sql . "<br>" . $conn->error;
             //     }
                 
             // $conn->close();
          $iq = mysqli_query($con , $sql);
          if($iq){
            //  echo "<h3> you are succssfully registered with registration no. $regno <br>save it for
            //  future reference <h3>";
          header("location:successreg.php?regno=$regno");
        }
        else{
           ?>
            <script>
               alert("registration denied");
           </script>
           <?php
        }
          
          
         }
         else
          echo  "passwords are not matching";
       }
    }
      ?>
        <div class="register">
          
                <form class="admlogin" action ="" method = "POST" >
                    <h3>Registration</h3>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Name</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name = "name" required>
                      
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">DOB</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name = "DOB" required>
                      
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Email</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" name = "email" required>
                      
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Programme</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name = "programme" required>
                      
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Batch</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name = "batch" required>
                      
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Branch</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name = "branch" required>
                      
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Password</label>
                      <input type="password" class="form-control" id="exampleInputEmail1" name = "password" required>
                      
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">CPassword</label>
                      <input type="password" class="form-control" id="exampleInputEmail1" name = "cpassword" required>
                      
                    </div>
                    <button type="submit"  name = "submit" class="btn btn-primary">Submit</button>
                    <a href="login.php">Already Registered?</a>;
                  </form>
           
           
        </div>
    
</body>
</html>