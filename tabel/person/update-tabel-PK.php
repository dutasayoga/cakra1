<?php
require_once('../../db.php');
if(isset($_POST["id"]))
{
   $value = mysqli_real_escape_string($conn, $_POST["value"]);
   $query = "UPDATE person SET ".$_POST["column_name"]."='".$value."' WHERE NIPEG = '".$_POST["id"]."'";
   if(mysqli_query($conn, $query))
   {
    return data;
   }
}
?>
