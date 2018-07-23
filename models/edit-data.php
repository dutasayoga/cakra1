<?php
require_once('../db.php');
include "../index.php";

$NIPEG =  mysqli_real_escape_string($conn,$_POST['NIPEG']);
$NAMA =  mysqli_real_escape_string($conn,$_POST['NAMA']);
$KDKRJ =  mysqli_real_escape_string($conn,$_POST['KDKRJ']);
$P_NILAI =  mysqli_real_escape_string($conn,$_POST['P_NILAI']);
$K_NILAI =  mysqli_real_escape_string($conn,$_POST['K_NILAI']);
$status = $_SESSION['user'];

if($_POST["NIPEG"] != '') {
   $query = "UPDATE person SET NAMA = '$NAMA', KDKRJ = '$KDKRJ', P_NILAI = '$P_NILAI', K_NILAI = '$K_NILAI', STATUS_PK = '$status' WHERE NIPEG = '$NIPEG'";
   if(mysqli_query($conn, $query)){
      echo "<script>window.location='index.php'</script>";
   }
}
 ?>
