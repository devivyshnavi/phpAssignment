<?php
$msg=$imgErr="";
include("cap.php");
if(isset($_POST["sub"])){
  $email=$_POST["mail"];
  $uname=trim($_POST["uname"]);
    $pswd=trim($_POST["pass"]);
    $gend=$_POST["gen"];
    $age=$_POST["age"];
    
    $tmp=$_FILES["att"]["tmp_name"];
    $fname=$_FILES["att"]["name"];
    $ext=pathinfo($fname,PATHINFO_EXTENSION);
    $fn=$email.".".$ext;
    if(empty($email)|| empty($uname)||empty($tmp)){
        $msg= "pls fill all the fields";
    }
     else{
         if(is_dir("users/".$email)){
         $msg= "User already exist";
           }
        else{
          if($_POST["cap"]==$_POST["capsum"]){
              mkdir("users/".$email);
              $pswd=substr(sha1($pswd),0,10);
              $fo=fopen("users/".$email."/details.txt","w");
              if(!empty($tmp)){
                $dest="users/".$email."/";
               if(move_uploaded_file($tmp,$dest.$fn)){
                fwrite($fo, $uname."\n".$pswd."\n".$age."\n".$gend."\n".$fn);
                   $msg="Registered successfully";
                   header("location:index.php?uid=$email");
                   
               }
               else{
                   $imgErr= "Upload error";
               }
           }
           }
           else{
             $msg="Invalid captcha";
           }
          }

     }  
          }
    ?>



<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body class="text-center">
    <div class="jumbotron">
  <h1>Register</h1>
  <form method="post" enctype="multipart/form-data">
  Email: <input type="email" name="mail" required/><br/><br/>
  username: <input type="text" name="uname" required/><br/><br/>
  Password: <input type="password" name="pass" required/><br/><br/>
  Age: <input type="text" name="age" required/><br/><br/>
  Gender &nbsp;&nbsp; 
 Male:<input type="radio" name="gen" value="male">
FeMale:<input type="radio" name="gen" value="female"><br/><br/>
Captcha:<b><?php echo $pat?></b><br/><br/>
<input type="text" name="cap"><br/><br/>
<input type="hidden" name="capsum" value="<?php echo $capsum?>">
Image <input type="file" name="att" value="upload" required><?php echo $imgErr;?>
<br/><br/>
  <input type="submit" name="sub" value="Register">
 
   <a href="index.php">Login</a><br/><br/>
  <?php 
    echo $msg;
  ?>
  
  
  </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    </body>
</html>