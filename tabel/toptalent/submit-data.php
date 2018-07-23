<?php
require_once('../../db.php');
if(isset($_POST["id"]))
{
   $query = "UPDATE person SET KDKRJ = '".$_POST["unitNext"]."', IDJOB = '".$_POST["jobNext"]."'  WHERE NIPEG = '".$_POST["id"]."'";
   if(mysqli_query($conn, $query))
   {
    return data;
   }
}
?>
