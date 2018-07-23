<?php require_once('../db.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title></title>
   </head>
   <body>
      <label>Choose a browser from this list:
         <div class="">
            <p contenteditable id="kdkrjNext" list="browsers" name="myBrowser" />dedd</p>
            <datalist id="browsers">
              <?php
              $query = "SELECT DISTINCT KDKRJ FROM kdtkerj";
              $result = mysqli_query($conn,$query);
              while ($row=mysqli_fetch_array($result)) {
                 ?><option value="<?php echo $row["KDKRJ"]; ?>"><?php echo $row["KDKRJ"]; ?>
              <?php } ?>
            </datalist>
         </div>
         <div class="">
            <label id="kdkrjNext-dtl">aa</label>
         </div>
   </body>
   <script type="text/javascript" src="../assets/DataTables/jQuery-3.3.1/jquery-3.3.1.min.js"></script>

   <script type="text/javascript">
      $(document).ready(function(){
         $(document).on('click change mouseenter', '#kdkrjNext', function() {
            var kdunitDtl = $('#kdkrjNext').text();
            $.ajax({
               url:"../models/getNamaUnit.php",
               method: "get",
               data: {'foo':kdunitDtl},
               success:function(msg) {
                  $('#kdkrjNext-dtl').text(msg);
               }
            })
         })
      })
   </script>
</html>
