<?php
 $connect = mysqli_connect("localhost", "root", "root", "cakra1");
 if(isset($_POST["query"]))
 {
      $output = '';
      $query = "SELECT KDKRJ FROM kdtkerj WHERE country_name LIKE '%".$_POST["query"]."%'";
      $result = mysqli_query($connect, $query);
      $output = '<ul class="list-unstyled">';
      if(mysqli_num_rows($result) > 0)
      {
           while($row = mysqli_fetch_array($result))
           {
                $output .= '<li>'.$row["KDKRJ"].'</li>';
           }
      }
      else  
      {
           $output .= '<li>Country Not Found</li>';
      }
      $output .= '</ul>';
      echo $output;
 }
 ?>
