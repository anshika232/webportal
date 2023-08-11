
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

       $email =  $_POST['email'];
       $password = $_POST['password'];
       
       $email_search = "select * from teachers where email = '$email'";
       $query = mysqli_query($con , $email_search);
       $count = mysqli_num_rows($query);
       if($count){
            $row = mysqli_fetch_assoc($query);
            $db_pass = $row['password'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['emp_no'] = $row['emp_no'];
            $pass_dec = password_verify($password , $db_pass);
            if($pass_dec){
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
                alert("password incorrect");
                </script>
                <?php
            }
        }
        else{
            ?>
            <script>
            alert("invalid email");
            </script>
            <?php
            
        }
    }

     ?>
       <div>
                    <a href="../index.php">Back to home</a>
                           
                    </div>
    
        <div class="login">
          
                <form class="admlogin" action = "<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method = "POST">
                    <h3>Teacher login</h3>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Email</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" name = "email">
                      
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword1" name = "password">
                    </div>
                    <div class="mb-3 form-check">
                      <a href="../teacher/register.php">Not Regsitered?</a>
                    </div>
                    <button type="submit"  name = "submit" class="btn btn-primary">Submit</button>
                  </form>
           
           
        </div>
    
</body>
</html>