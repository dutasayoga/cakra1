<?php
require_once('../db.php');

if(isset($_POST['login'])) {
    $id = mysqli_real_escape_string($conn,$_POST['user']);
    $pass = mysqli_real_escape_string($conn,$_POST['pass']);
    $sql_login = mysqli_query($conn, "SELECT * FROM profile WHERE username = '$id' AND password = '$pass'") or die (mysqli_error);
    if(mysqli_num_rows($sql_login) > 0) {
        $_SESSION['admin'] = $id;
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