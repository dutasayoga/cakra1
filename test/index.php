<?php
 $connect = mysqli_connect("localhost", "root", "root", "testing");
 $query = "SELECT * FROM tbl_employee ORDER BY id desc";
 $result = mysqli_query($connect, $query);
 ?>
 <!DOCTYPE html>
 <html>
      <head>
           <title>Webslesson Tutorial | PHP AJAX Jquery - Load Dynamic Content in Bootstrap Popover</title>
           <script src="../assets/DataTables/jQuery-3.3.1/jquery-3.3.1.min.js"></script>
           <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
           <script src="../assets/js/bootstrap.min.js"></script>
      </head>
      <body>
           <br /><br />
           <div class="container" style="width:800px;">
                <h2 align="center">PHP AJAX Jquery - Load Dynamic Content in Bootstrap Popover</h2>
                <h3 align="center">Employee Data</h3>
                <br /><br />
                <div class="table-responsive">
                     <table class="table table-bordered">
                          <tr>
                               <th width="20%">ID</th>
                               <th width="80%">Name</th>
                          </tr>
                          <?php
                          while($row = mysqli_fetch_array($result))
                          {
                          ?>
                          <tr>
                               <td><?php echo $row["id"]; ?></td>
                               <td><a href="#" class="hover" id="<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></a></td>
                          </tr>
                          <?php
                          }
                          ?>
                     </table>
                </div>
           </div>
      </body>
 </html>
 <script>
      $(document).ready(function(){
           $('.hover').popover({
                title:fetchData,
                html:true,
                trigger:'hover',
                placement:'right'
           });
           function fetchData(){
                var fetch_data = '';
                var element = $(this);
                var id = element.attr("id");
                $.ajax({
                     url:"fetch.php",
                     method:"POST",
                     async:false,
                     data:{id:id},
                     success:function(data){
                          fetch_data = data;
                     }
                });
                return fetch_data;
           }
      });
 </script>
