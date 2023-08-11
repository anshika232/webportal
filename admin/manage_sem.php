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
<body>
<style>
    *{
        margin : 0;
        padding: 0;
    }
    #manage_form{
        display: flex;
       align-content: center;
       flex-direction: column;
       align-self: center;
       background: rgba(0, 0, 0, 0.5);
       height: 100vh;
    }
    
    .admlogin{
       margin: auto;
       width: 40%;
       padding: 13px 13px;
       display: flex;
       align-content: center;
       flex-direction: column;
       align-self: center;
       
       /* margin : 10px 10px 10px 10px;
       width: 50%;
       height: 40vh;
       position:absolute;
       left: 40%;
       top:20%;*/
       background-color: white;
       
       
       
    
    }
    .aligncenter{
        display: flex;
       align-content: center;
       flex-direction: column;
       align-self: center;

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
        padding: 10px 10px;
    }
    .btmanage:hover {
     color: white;
    }
</style>
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
     $sql4 = "select * from semester where batch = '$batch' and prgm = '$prgm' order by sem desc limit 1";
     $q4 = mysqli_query($con , $sql4);
     $r4 = mysqli_fetch_assoc($q4);
     $sem = $r4['sem'];
     $id = $r4['S.no.'];
    
     $sql2 = "select sem from semester where batch = '$batch' and prgm = '$prgm' order by sem desc limit 1";
        $q2 = mysqli_query($con , $sql2);
        $r2 = mysqli_fetch_assoc($q2);
        
        $sql3 = "select status from semester where batch = '$batch' and prgm = '$prgm' and sem = '$r2[sem]'";
        $q3 = mysqli_query($con , $sql3);
        $r3 = mysqli_fetch_assoc($q3);
        $val = $r3['status'];
 }


?>
<div id = "manage_form">

<form class="admlogin" action = ""  method = "POST">
    <div class="aligncenter">
    <?php
    if(isset($_POST['submit'])){
           echo $batch;
           echo " ";
            echo $prgm;
            echo "<h3> Sem : $sem</h3>";
        }
     ?>
    </div>
    
              
              <label class="my-1 mr-2" for="dropdown" >Batch</label>
                <select class="custom-select my-1 mr-sm-2" id='dropdown' name = "type" required>
                  <?php
                   $sql1 = "select distinct batch from semester";
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
              
                <div>
          <button type="submit" name = "submit" class="btn btn-primary">Submit</button>

        </div>
            
            
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
           $btn3 = "Declared Result";
           $id1 = "gde";
            $id2 = "mke";
            $id3 = "dr";
        }
        
        $func1 = "functionstart1($id)";
        $update = "update";
        $func2 = "functionstart2($id)";
        $func3 = "functionstart3($id)";
     
        echo "</br></br>";
        echo "<button type=$bn1 id = $id1 name = $id1 onclick =$func1  value = $update class= $class>$btn1</button>";
        echo "<button type=$bn1 id = $id2 name = $id2 onclick =$func2  value = $update class= $class>$btn2</button>";
        echo "<button type=$bn1 id = $id3 name = $id3 onclick =$func3  value = $update class= $class>$btn3</button>"; 
        
  
        
        
        ?>
        
         <a href="dashboard.php">Back to Dashboard</a>
        </form>
    </div>
       
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
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
   </script>
    
</body>
</html>