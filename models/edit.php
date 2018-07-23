<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "cakra");
if(isset($_POST["NIPEG"]))
{
   $query = "SELECT * FROM person WHERE NIPEG = '".$_POST["NIPEG"]."'";
   $result = mysqli_query($connect, $query);
   $row = mysqli_fetch_array($result);
   echo json_encode($row);
}
?>
