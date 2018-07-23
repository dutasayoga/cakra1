<?php

require_once("../../db.php");

if(isset($_POST["id"]))
{
   $output = '';
   $query = "SELECT DIREKT, DIVISI, BAGIAN, URUSAN FROM kdtkerj WHERE KDKRJ = '".$_POST["id"]."'";
   $result = mysqli_query($conn, $query);
   while($row = mysqli_fetch_array($result))
   {
      $output = '
         <p> '.$row["DIREKT"].' / '.$row["DIVISI"].' / '.$row["BAGIAN"].' / '.$row["URUSAN"].' </p>
      ';
   }
   echo $output;

}
 ?>
