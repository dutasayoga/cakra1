
<table width="100%" id="tabel-jobttl" class="table table-hover table-responsive table-bordered table-striped">
  <thead>
    <tr>
      <th>ID Job</th>
      <th>Jobtitle</th>
      <th>Utilisasi</th>
    </tr>
  </thead>
</table>

<script type="text/javascript" src="assets/DataTables/jQuery-3.3.1/jquery-3.3.1.js"></script>
<script type="text/javascript" src="assets/DataTables/DataTables-1.10.18/js/jquery.datatables.min.js"></script>
<script type="text/javascript"
src="assets/DataTables/DataTables-1.10.18/js/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function() {
   fetch_data();

   function fetch_data()
   {
      var dataTable = $('#tabel-jobttl').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order" : [],
        "ajax" : {
           url:"tabel/jobtitle/server-side-jobtitle.php",
           type:"POST"
        }
      });
   }

   function update_data(id, column_name, value) {
      $.ajax({
         url:"tabel/jobtitle/update-tabel-keyC.php",
         method:"POST",
         data:{id:id, column_name:column_name, value:value},
         success:function(data)
         {
           $('#tabel-jobttl').DataTable().fnDraw();
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
