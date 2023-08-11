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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
     
</head>
<style>
    body{
    background-image: url(../mnnit.jpg);
   background-repeat: no-repeat;
   background-position: 50px 50px 0px 0px;
   background-size: 100%;
   
  }
  #btni{
    display: flex;
   flex-direction: column;
   align-items: center;
   align-content: center;
  margin-top: 60px;
  }
    *{
        margin : 0;
        padding: 0;
    }
    #manage_form{
    position: absolute;
    top: 0px;
    left: 0px;
    height: 100%;
    width: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: none;
    color: #676767;
    }
    
    .admlogin{
       /* margin : 10px 10px 10px 10px;
       width: 30%;
       display: flex;
       align-content: center;
       flex-direction: column;
       align-self: center; */
       
       margin : 10px 10px 10px 10px;
       width: 50%;
       height: 40vh;
       position:absolute;
       left: 40%;
       top:20%;
       background-color: white;
       flex-direction: column;


       align-items: center;
       
       
    
    }
    
    .admlogin .btn{
        width: 40%;
    }
    .menu{
        margin: 15px 15px;
        padding: 15px 20px;
        width: 250px;
        
    }
    .btmanage{
        width: 150px;
        margin: 10px 10px;
    }
    .btmanage:hover {
     color: white;
    }
</style>
<body>
<?php
 include '../connection.php';
 $id = -1;
  $val = 0;
  $prgm = "M.Tech";
 if(isset($_POST['submit'])){
     
    $batch = mysqli_real_escape_string($con,$_POST['type']);
    
     $p= mysqli_real_escape_string($con,$_POST['prgm']);
     $prgm = "MCA";
     if($p == 1)
     $prgm = "B.tech.";
     else if($p == 2)
     $prgm = "M.tech.";
     $sql4 = "select * from semester where batch = '$batch' and prgm = '$prgm'";
     $q4 = mysqli_query($con , $sql4);
     $r4 = mysqli_fetch_assoc($q4);
     $sem = $r4['sem'];
     $id = $r4['S.no.'];
    
     $sql2 = "select sem from semester where batch = '$batch' and prgm = '$prgm'";
        $q2 = mysqli_query($con , $sql2);
        $r2 = mysqli_fetch_assoc($q2);
        
        $sql3 = "select status from semester where batch = '$batch' and prgm = '$prgm' and sem = '$r2[sem]'";
        $q3 = mysqli_query($con , $sql3);
        $r3 = mysqli_fetch_assoc($q3);
        $val = $r3['status'];
 }


?>
<div class="dropdown">
  <a class="menu btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
   <?php 
    include '../connection.php';
    echo $_SESSION['id'];
    

    
    ?>
  </a>
   
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
  <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
  
  <div>

</div>
 

    
  </ul>
<div id = "manage_form">

<form class="admlogin" action = ""  method = "POST">
    <?php
    if(isset($_POST['submit'])){
        echo $batch;
            echo $prgm;
            echo "<h3> Sem : $sem</h3>";
        }
     ?>
              
              <label class="my-1 mr-2" for="dropdown" >Type</label>
                <select class="custom-select my-1 mr-sm-2" id='dropdown' name = "type" required>
                  <?php
                   $sql1 = "select * from semester";
                   $q1 = mysqli_query($con , $sql1);
                   while($r1 = mysqli_fetch_assoc($q1))
                   {
                     $batch = $r1['batch'];
                    echo "<option value=$batch >$batch</option>";
                
                 
                   }
                   ?>
                </select>
                
                <label for="prog" class="form-label">programme</label>
                <select class="custom-select my-1 mr-sm-2" id='prog' name = "prgm" required>
                  
                    <option value="1" >B.tech.</option>
                    <option value="2" >M.tech.</option>
                    <option value="3" >MCA</option>
                
                </select>
              
                
            
            
            <?php
        
        
         
         $bn1 = "button";
         $class = "btmanage btn btn-primary btn-lg";
        if($val == 0){
        $btn1 = "grade Entry start";
        $id1 = "gde";
        $btn2 = "marks entry start";
        $id2 = "mke";
        $btn3 = "Declare Result";
        $id3 = "dr";
        }
        else if($val == 1){
        $btn1 = "grade_Entry_stop";
        $id1 = "gds";
        $btn2 = "marks entry start";
        $id2 = "mke";
        $btn3 = "Declare Result";
        $id3 = "dr";
        }
        else if($val == 2){
            $btn1 = "grade_Entry_start";
            $id1 = "gde";
            $btn2 = "marks entry start";
            $id2 = "mke";
            $btn3 = "Declare Result";
            $id3 = "dr";
            }
        else if($val == 3){
            $btn1 = "grade Entry start";
            $btn2 = "marks entry stop";
            $btn3 = "Declare Result"; 
            $id1 = "gde";
            $id2 = "mks";
            $id3 = "dr";
        }
        else if($val == 4){
            $btn1 = "grade Entry start";
            $btn2 = "marks entry start";
            $btn3 = "Declare Result"; 
            $id1 = "gde";
            $id2 = "mke";
            $id3 = "dr";
        }
        else if($val == 5){
           $btn1 = "grade Entry start";
           $btn2 = "marks entry start";
           $btn3 = "Declare Result";
           $id1 = "gde";
            $id2 = "mke";
            $id3 = "dr";
        }
        
        $func1 = "functionstart1($id)";
        $update = "update";
        $func2 = "functionstart2($id)";
        $func3 = "functionstart3($id)";
        echo "<button type=$bn1 id = $id1 name = $id1 onclick =$func1  value = $update class= $class>$btn1</button>";
        echo "<button type=$bn1 id = $id2 name = $id2 onclick =$func2  value = $update class= $class>$btn2</button>";
        echo "<button type=$bn1 id = $id3 name = $id3 onclick =$func3  value = $update class= $class>$btn3</button>"; 
        
  
        
        
        ?>
        <div>
          <button type="submit" name = "submit" class="btn btn-primary">Submit</button>

        </div>
        </form>
            <!-- <?php
        // if(array_key_exists('grade Entry start', $_POST)) {
        //     button1();
        // }
        // else if(array_key_exists('grade_Entry_stop', $_POST)) {
        //     button2();
        // }
        // else if(array_key_exists('marks entry start', $_POST)) {
        //     button3();
        // }
        // else if(array_key_exists('marks entry stop', $_POST)) {
        //     button4();
        // }
        // else if(array_key_exists('Declare Result', $_POST)) {
        //     button5();
        // }
        // function button1() {
        //     echo "This is Button1 that is selected";
        // }
        // function button2() {
        //     echo "This is Button2 that is selected";
        // }
        // function button3() {
        //     echo "This is Button3 that is selected";
        // }
        // function button4() {
        //     echo "This is Button4 that is selected";
        // }
        // function button5() {
        //     echo "This is Button5 that is selected";
        // }
    ?> -->
 
       
   </div>
   <div id = "btni">

   <div>
<!-- <a href="" id = "btn1" class="menu btn btn-primary btn-lg active"  role="button" aria-pressed="true">Enter Marks Distribution</a> -->
<a href="manage_sem.php" class="menu btn btn-primary btn-lg " role="button" aria-pressed="true">Manage Sem </a>
<!-- <button type="button" id = "btn2"class="menu btn btn-primary btn-lg btm">Enter Marks Distribution</button> -->

</div>
<div>

<a href="addcourses.php" class="menu btn btn-primary btn-lg " role="button" aria-pressed="true">Add Courses </a>

</div>
<div>
<a href="changesem.php" class="menu btn btn-primary btn-lg " role="button" aria-pressed="true">Change Sem</a>


  
</div>

<div>
<a href="teachersn.php" class="menu btn btn-primary btn-lg " role="button" aria-pressed="true">Teachers List </a>
 

</div>

   
   </div>

   
    
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

       <script>
       $(document).ready(function () {
  $("#manage_form").hide();
    $("#btn2").click(function () {
        $("#manage_form").show();
    });
   
});
</script>
<script>
      
         function functionstart1(val)
        { 
            console.log("in function-- " + val);
            var hit = 1;
            // var data = 'id='+val+'&hit='+hit;
            // console.log(data);
        
            jQuery.ajax({
                url : 'lock.php',
                type : 'post',
                data: {
                    id:val,
                    hit:hit
                },
                
                success:function(data , status){
                
                console.log("success");
                }
            

            });
        }
        function functionstart2(val)
        { 
            console.log("in function-- " + val);
            var hit = 2;
            // var data = 'id='+val+'&hit='+hit;
            // console.log(data);
        
            jQuery.ajax({
                url : 'lock.php',
                type : 'post',
                data: {
                    id:val,
                    hit:hit
                },
                
                success:function(data , status){
                
                console.log("success");
                }
            

            });
        }
        function functionstart3(val)
        { 
            console.log("in function-- " + val);
            var hit = 3;
            // var data = 'id='+val+'&hit='+hit;
            // console.log(data);
        
            jQuery.ajax({
                url : 'lock.php',
                type : 'post',
                data: {
                    id:val,
                    hit:hit
                },
                
                success:function(data , status){
                
                console.log("success");
                }
            

            });
        }
        function updateData(id){
    console.log("event fired");
       
        var hit = 1;
        var data = 'id='+id+'&hit='+hit;
        console.log(data);
        
        jQuery.ajax({
            url : 'lock.php',
            type : 'post',
            data: data,
            
            success:function(data , status){
               
               console.log("success");
            }
          

        });
        
        
       }

       
       
   
        //  function functionstart2(value){
        //     console.log("in function-- " + value);
        //     var hit = 2;
        //     var data = 'id='+value+'&hit='+hit;
        //     console.log(data);
        
        //     jQuery.ajax({
        //         url : 'lock.php',
        //         type : 'post',
        //         data: data,
                
        //         success:function(data , status){
                
        //         console.log("success");
        //         }
            

        //     });
          

       
        //  }
        //  function functionstart3(value){
        //     console.log("in function-- " + value);
        //     var hit = 3;
        //     var data = 'id='+value+'&hit='+hit;
        //     console.log(data);
        
        //     jQuery.ajax({
        //         url : 'lock.php',
        //         type : 'post',
        //         data: data,
                
        //         success:function(data , status){
                
        //         console.log("success");
        //         }
            

        //     });
          

        
        //  }
        </script>
   
</body>
</html>