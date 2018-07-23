<?php
require_once("../db.php");
if(isset($_SESSION['user'])){
   echo "<script>window.location='../index.php';</script>"; 
} else { 
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE-edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>LOGIN PAGE</title>
      <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
      <link rel="icon" href="../assets/Images/home.png">

   </head>
   <body>
      <div class="wrapper">
         <div class="container">
            <div align="center" style="margin-top:250px;">
                <?php
                if(isset($_POST['login'])) {
                    $id = mysqli_real_escape_string($conn,$_POST['user']);
                    $pass = mysqli_real_escape_string($conn,$_POST['pass']);
                    $sql_login = mysqli_query($conn, "SELECT * FROM profile WHERE username = '$id' AND password = '$pass'") or die (mysqli_error);
                    if(mysqli_num_rows($sql_login) > 0) {
                        $_SESSION['user'] = $id;
                        echo "<script>window.location='../index.php';</script>";
                    } else {?>
                        <div class="row">
                            <div class="col-lg-6 col-lg-offset-3">
                                <div class="alert alert-danger alert-dismissable" role="alert">
                                    <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    <strong>Login Gagal !</strong> Username dan Password salah !!!
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                } 
                ?>
               <form class="form-inline" action="login.php" method="post">
                  <div class="form-group">
                     <span class="form-group"><i class="glyphicon glyphicon-user"></i></span>
                     <input type="text" class="form-control" name="user" placeholder="Username..." required autofocus>
                  </div>
                  <div class="form-group">
                     <span class="form-group"><i class="glyphicon glyphicon-lock"></i></span>
                     <input type="password" class="form-control" name="pass" placeholder="Password..." required>
                  </div>
                  <div class="form-group">
                     <input type="submit" name="login" class="btn btn-primary" value="LOGIN">
                  </div>
               </div>
            </div>
         </div>
      </div>

   </body>
</html>
<?php
}
?>
