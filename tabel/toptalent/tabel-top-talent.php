<style media="screen">
   .editableCell{
      background-color: white;
   }
   .non-editableCell{
      background-color: #f1f1f1;
   }
   .head-tabel{
      background-color: white;
   }
</style>
<table width="100%" id="tabel-toptal" class="table table-responsive table-bordered ">
  <thead>
    <tr>
      <th class="head-tabel">NIP</th>
      <th class="head-tabel">Nama</th>
      <th class="head-tabel">Kode Unit</th>
      <th class="head-tabel">ID job</th>
      <th class="head-tabel">F/M</th>
      <th class="head-tabel">Kode Unit</th>
      <th class="head-tabel">ID job</th>
      <th class="head-tabel">action</th>
    </tr>
  </thead>
</table>
<script type="text/javascript" src="assets/DataTables/jQuery-3.3.1/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="assets/DataTables/DataTables-1.10.18/js/jquery.datatables.min.js"></script>
<script type="text/javascript" src="assets/DataTables/DataTables-1.10.18/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.js"></script>
<script>
$(document).ready(function() {
   fetch_data();

   function fetch_data()
   {
      var dataTable = $('#tabel-toptal').DataTable({
         "processing" : true,
         "serverSide" : true,
         "order" : [],
         "ajax" : {
           url:"tabel/toptalent/server-side-tt.php",
           type:"POST"
         },
         drawCallback: function () {
            $('.hover').tooltip({
               title:fetchData,
               "html": true,
               trigger: 'hover',
               placement: 'right'
            });

            $('.hoverj').tooltip({
               title:fetchDataJob,
               "html": true,
               trigger: 'hover',
               placement: 'right'
            });

            function fetchData() {
               var fdata = '';
               var element = $(this);
               var id = element.attr("id");
               $.ajax({
                  url: "tabel/toptalent/popover-kdunit.php",
                  method: "POST",
                  async:false,
                  data:{id:id},
                  success: function(data){
                     fdata = data;
                  }
               });
               return fdata;
            }

            function fetchDataJob() {
               var fdata = '';
               var element = $(this);
               var id = element.attr("id");
               $.ajax({
                  url: "tabel/toptalent/popover-kdunit-job.php",
                  method: "POST",
                  async:false,
                  data:{id:id},
                  success: function(data){
                     fdata = data;
                  }
               });
               return fdata;
            }
         }
      });
   }

   function update_data(id, column_name, value) {
      $.ajax({
         url:"tabel/toptalent/update-tabel-tt.php",
         method:"POST",
         data:{id:id, column_name:column_name, value:value},
         success:function(data)
         {
           $('#tabel-toptal').DataTable().destroy();
           fetch_data();
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

   function submit_data(id, jobNext, fm, unitNext) {
      $.ajax({
         url:"tabel/toptalent/submit-data.php",
         method:"POST",
         data:{id:id, jobNext:jobNext, fm:fm, unitNext:unitNext},
         success:function(data)
         {
           $('#tabel-toptal').DataTable().destroy();
           fetch_data();
         }
      });
      setInterval(function(){
         $('#alert_message').html('');
      }, 5000);
   }

   $(document).on('click', '#submit-data', function(){
      var id = $(this).data("id");
      var jobNext = $(this).data("job");
      var fm = $(this).data("fm");
      var unitNext = $(this).data("unit");
      if(fm == "F"){
         alert("tidak bisa di update !!!!")
      } else {
         submit_data(id,jobNext,fm,unitNext);
         alert("Data Updated");
      }

   })

});
</script>
