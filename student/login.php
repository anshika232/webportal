<?php
session_start();

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
            $regno = $_POST['reg_no'];
            $password = $_POST['password'];
            if($regno == "090909" &&  $password == "$%^&"){
                $_SESSION['id'] = '12345';
                
                ?>
                    <script>
                     alert("login successful");
                     location.replace("../admin/dashboard.php");
                    </script>
                    <?php
            }
            $query = " select * from students where reg_no = '$regno' ";

            $q = mysqli_query($con , $query);
            $ct = mysqli_num_rows($q);
            if($ct){
                $email_pass = mysqli_fetch_assoc($q);
                $db_pass = $email_pass['password'];
                $_SESSION['name'] = $email_pass['name'];
                $_SESSION['reg_no'] = $email_pass['reg_no'];
                $pass_decode = password_verify($password , $db_pass);
                if($pass_decode){
                    ?>
                    <script>
                    //  alert("login successful");
                     location.replace("dashboard.php");
                    </script>
                    <?php
                }
                else{
                    ?>
                    <script>
                    alert("password incorrect..");
                    </script>
                    <?php
                }
            }
            else{
                ?>
                <script>
                alert("invalid regno..");
                </script>
                <?php
                
            }
        }
       ?>
                    <div>
                    <a href="../index.php">Back to home</a>
                           
                    </div>
        <div class="login">
          
                <form class="admlogin" action = "<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"  method = "POST">
                    <h3>Student login</h3>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Registration no.</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name = "reg_no">
                      
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword1" name = "password">
                    </div>
                    <div class="mb-3 form-check">
                      <a href="register.php">Not Registered?</a>
                       

                    </div>
                  
                    <button type="submit" name = "submit" class="btn btn-primary">Submit</button>
                    
                  </form>
           
           
        </div>
        
    
</body>
</html>