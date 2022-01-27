<?php
$uErr="";
if(isset($_POST["sub"])){
    $mail=$_POST["mail"];
    $password=$_POST["pswd"];
    $real=$password;
    if(!empty($mail)){
        if(is_dir("users/".$mail)){
            $uErr="";
            $fo=fopen("users/".$mail."/details.txt","r");
            fgets($fo);
            $pass=trim(fgets($fo));
            $password=substr(sha1($password),0,10);
            if($pass==$password){
                if(!empty($_POST["chck"])){
                    setcookie("email", $mail,time()+3600);
                    setcookie("pass1", $real,time()+3600);
                }
                session_start();
                $_SESSION["mailid"]=$mail;
                header("location:dashboard.php");
            }
            else{
                $uErr="Please enter correct details";
            }
        }
   else{
        $uErr="Please enter correct details";
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
    
        <script>
        function cook(){
    if("<?php echo $_COOKIE["email"]?>" !=undefined){
    if(document.getElementById("email").value == "<?php echo $_COOKIE["email"]?>"){
        document.getElementById("password").value="<?php echo $_COOKIE["pass1"]?>"
    }
    else{
        document.getElementById("password").value="";
    }
    }
        }
    </script>
    
    
    </head>
    <body class="text-center">
    <div class="jumbotron">
  <h1>Login</h1>
  <form method="post">
  Email: <input type="email" id="email" name="mail" onchange="cook()"/>
  <br/><br/>
  Password: <input type="password" id="password" name="pswd" />
  <br/><br/>
  <input type="checkbox" name="chck" id="remem">Remember me<br/><br/>
  <input type="submit" name="sub" value="login">
  <a href="register.php">New user</a><br/>
  <?php echo $uErr;?>
  </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    </body>
</html>