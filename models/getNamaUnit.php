<?php
require_once('../db.php');
$query = "SELECT CONCAT(DIREKT,'/ ',DIVISI,'/ ',BAGIAN,'/ ',URUSAN) as detail FROM kdtkerj WHERE KDKRJ = '".$_GET["foo"]."' ";
$result = mysqli_query($conn, $query);
while ($row = $result->fetch_assoc()){
   echo $row['detail'];
}
?>
