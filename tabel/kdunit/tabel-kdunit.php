<div  id="sort-view" style="margin-top:2px;  width:100%; height:14vh;">
   <div style="padding-left:15px;">
      <div class="form-horizontal" >
         <div class="form-group">
            <label class="control-label col-sm-1" for="kdunit">Kode Unit :</label>
            <div class="col-sm-2">
               <select name="kdunit" id="kdunit" class="form-control input-sm">
                  <option value="">search...</option>
                  <?php
                  $query1 = "SELECT DISTINCT DIVISI kdunit FROM kdtkerj";
                  $result1 = mysqli_query($conn, $query1);
                  while($row1 = mysqli_fetch_array($result1))
                  {
                  echo '<option value="'.$row1["kdunit"].'">'.$row1["kdunit"].'</option>';
                  }
                  ?>
               </select>
            </div>
            <div class="col-sm-4">
               <input type="text" style="border:0px; color:CCC;"class="form-control input-sm" id="kdunit-dtl" placeholder="......." name="">
            </div>
         </div>

         <div class="form-group">
            <label class="col-sm-1"></label>
            <div class="col-sm-4">
               <button type="button" name="view-sort" id="view-sort" class="btn btn-info btn-sm" value="Sort">sort</button>
            </div>
         </div>
      </div>
   </div>
</div>
<table width="100%" id="tabel-kdunit" class="table table-hover table-responsive table-bordered table-striped">
  <thead>
    <tr>
      <th>Kode Unit</th>
      <th>Key Utilisasi</th>
      <th>Direkt</th>
      <th>Divisi</th>
      <th>Bagian</th>
      <th>Urusan</th>
    </tr>
  </thead>
</table>

<script type="text/javascript" src="assets/DataTables/jQuery-3.3.1/jquery-3.3.1.js"></script>
<script type="text/javascript" src="assets/DataTables/DataTables-1.10.18/js/jquery.datatables.min.js"></script>
<script type="text/javascript"
src="assets/DataTables/DataTables-1.10.18/js/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function() {
   fetch_data('no');

   function fetch_data(is_sort, kdunit='')
   {
      var dataTable = $('#tabel-kdunit').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order" : [],
        "ajax" : {
           url:"tabel/kdunit/server-side-kdunit.php",
           type:"POST",
           data:{is_sort:is_sort, kdunit:kdunit}
        }
      });
   }

   $('#view-sort').click(function(){
      var kdunit = $('#kdunit').val();
      if(kdunit != '' || kdunit == "")
      {
         $('#tabel-kdunit').DataTable().destroy();
         fetch_data('yes', kdunit);
      } else {
         alert("error");
      }
   })

   function update_data(id, column_name, value) {
      $.ajax({
         url:"tabel/kdunit/update-tabel-keyU.php",
         method:"POST",
         data:{id:id, column_name:column_name, value:value},
         success:function(data)
         {
           $('#tabel-kdunit').DataTable().fnDraw();
         }
      });
      setInterval(function(){
         $('#alert_message').html('');
      }, 5000);
   }

   $(document).on('blur', '.update', function(){
      var id = $(this).data("id");
      var column_name = $(this).data("column");
      var value = $(this).text();
      update_data(id, column_name, value);
   })
})
</script>
