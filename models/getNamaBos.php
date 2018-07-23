<?php
require_once('../db.php');
$query = "SELECT NAMA FROM person WHERE NIPEG = '".$_GET["foo"]."' ";
$result = mysqli_query($conn, $query);
while ($row = $result->fetch_assoc()){
   echo $row['NAMA'];
}
?>
