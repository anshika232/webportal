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
         $name = mysqli_real_escape_string($con,$_POST['name']) ;
         $email = mysqli_real_escape_string($con,$_POST['email']);
         $phone = mysqli_real_escape_string($con,$_POST['phone']);
         $dept = mysqli_real_escape_string($con,$_POST['dept']);
         $empno = mysqli_real_escape_string($con,$_POST['emp_no']);
         $password = mysqli_real_escape_string($con,$_POST['password']);
         $cpassword = mysqli_real_escape_string($con,$_POST['cpassword']);
         
         $pass = password_hash($password , PASSWORD_BCRYPT);
         $cpass = password_hash($cpassword , PASSWORD_BCRYPT);

         $email_query = "select * from teachers where email = '$email'";
         $query = mysqli_query($con , $email_query);

         $count = mysqli_num_rows($query);

         if($count > 0){
             echo "Email already exists";
         }
         else{
          if($password === $cpassword){
             $sql = "insert into teachers(emp_no,name, email, phone, dept, password, cpassword) 
             values('$empno', '$name', '$email' , '$phone' , '$dept' , '$pass' , '$cpass')";

             $iq = mysqli_query($con , $sql);
             if($iq){
              ?>
              <script>
                  alert("registered successfully");
              </script>
              <?php
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
          
                <form class="admlogin" action = "" method = "POST">
                    <h3>Registration</h3>
                    
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Name</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name = "name" required>
                      
                    </div>
            
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Email</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" name = "email" required>
                      
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Phone no.</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name = "phone" required>
                      
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Department</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name = "dept" required>
                      
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Employement no.</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name = "emp_no" required>
                      
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