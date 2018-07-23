<?php

require_once("../../db.php");

if(isset($_POST["id"]))
{
   $output = '';
   $query = "SELECT JOBTITLE FROM jobtitle WHERE IDJOB = '".$_POST["id"]."'";
   $result = mysqli_query($conn, $query);
   while($row = mysqli_fetch_array($result))
   {
      $output = '
         <p> '.$row["JOBTITLE"].'</p>
      ';
   }
   echo $output;

}
 ?>
