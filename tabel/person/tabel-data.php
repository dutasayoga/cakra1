<style>
th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        margin: 0 auto;
    }

    tr { height: 50px; }

#tabel-main {
   margin-top: 200;
}
</style>
<div  id="sort-view" style="margin-top:2px;  width:100%; height:14vh;">
   <div style="padding-left:15px;">
      <div class="form-horizontal" >
         <div class="form-group">
            <label class="control-label col-sm-1" for="kdunit">Kode Unit :</label>
            <div class="col-sm-2">
               <select name="kdunit" id="kdunit" class="form-control input-sm">
                  <option value="">search...</option>
                  <?php
                  $query1 = "SELECT DISTINCT person.KDKRJ kdunit FROM person INNER JOIN kdtkerj ON person.KDKRJ = kdtkerj.KDKRJ";
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
            <label class="control-label col-sm-1" for="nipegup">N.I.P :</label>
            <div class="col-sm-2">
               <select name="nipegup" id="nipegup" class="form-control input-sm">
            		<option value="">search....</option>
            		<?php
                  $query = "SELECT DISTINCT p2.NIPEG as nipbos FROM person p1 INNER JOIN person p2 ON p1.NIPEG_UP = p2.NIPEG";
                  $result = mysqli_query($conn, $query);
            		while($row = mysqli_fetch_array($result))
            		{
            		 echo '<option value="'.$row["nipbos"].'">'.$row["nipbos"].'</option>';
            		}
            		?>
         		</select>
            </div>
            <div class="col-sm-4">
               <input style="border:0px; color:CCC;"type="text" class="form-control input-sm" id="nipegup-dtl" placeholder="...." name="">
            </div>
         </div>
         <div class="form-group">
            <label class="control-label col-sm-1" for="pValue">Nilai P :</label>
            <div class="col-sm-1">
               <select class="form-control input-sm" id="pValue" name="pValue">
                  <option value="0"></option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
               </select>
            </div>
            <label class="control-label col-sm-1" for="kValue">Nilai K :</label>
            <div class="col-sm-1">
               <select class="form-control input-sm" id="kValue" name="kValue">
                  <option value="0"></option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
               </select>
            </div>
            <div class="col-sm-1">
               <button type="button" name="view-sort" id="view-sort" class="btn btn-info btn-sm" value="Sort">sort</button>
            </div>
         </div>
      </div>
   </div>
</div>
<table width="100%" id="tabel-main" class="table table-hover table-responsive table-bordered table-striped">
  <thead>
    <tr>
      <th>NIP</th>
      <th>Nama</th>
      <th>Nilai P</th>
      <th>Nilai K</th>
      <th>Nama Atasan</th>
      <th>Direkt</th>
      <th>Divisi</th>
      <th>Bagian</th>
      <th>Urusan</th>
      <th>Jobtitle</th>
      <th>e-mail</th>
      <th>Status</th>
      <th>Tanggal Update</th>
    </tr>
  </thead>
</table>
<script type="text/javascript" src="assets/DataTables/jQuery-3.3.1/jquery-3.3.1.js"></script>
<script type="text/javascript" src="assets/DataTables/DataTables-1.10.18/js/jquery.datatables.min.js"></script>
<script type="text/javascript"
src="assets/DataTables/DataTables-1.10.18/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="assets/DataTables/fixedColumns-3.2.5/js/dataTables.fixedColumns.min.js"></script>
<script type="text/javascript" src="assets/DataTables/JSZip-2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="assets/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="assets/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="assets/DataTables/Buttons-1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="assets/DataTables/Buttons-1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="assets/DataTables/Buttons-1.5.2/js/buttons.print.min.js"></script>

<script>
$(document).ready(function(){

var oldExportAction = function (self, e, dt, button, config) {
          if (button[0].className.indexOf('buttons-excel') >= 0) {
              if ($.fn.dataTable.ext.buttons.excelHtml5.available(dt, config)) {
                  $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config);
              }
              else {
                  $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
              }
          } else if (button[0].className.indexOf('buttons-print') >= 0) {
              $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
          } else if (button[0].className.indexOf('buttons-csv') >= 0) {
             if ($.fn.dataTable.ext.buttons.csvHtml5.available(dt, config)) {
                 $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config);
             }
             else {
                 $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
             }
          }
      };

var newExportAction = function (e, dt, button, config) {
       var self = this;
       var oldStart = dt.settings()[0]._iDisplayStart;

       dt.one('preXhr', function (e, s, data) {
           // Just this once, load all data from the server...
           data.start = 0;
           data.length = 2147483647;

           dt.one('preDraw', function (e, settings) {
               // Call the original action function
               oldExportAction(self, e, dt, button, config);

               dt.one('preXhr', function (e, s, data) {
                   // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                   // Set the property to what it was before exporting.
                   settings._iDisplayStart = oldStart;
                   data.start = oldStart;
               });

               // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
               setTimeout(dt.ajax.reload, 0);

               // Prevent rendering of the full data to the DOM
               return false;
           });
       });

       // Requery the server with the new one-time export settings
       dt.ajax.reload();
   };

fetch_data('no');

function fetch_data(is_sort, nipegup='', pValue='', kValue='', kdunit='')
{
    var dataTable = $('#tabel-main').DataTable({
              scrollX : true,
              scrollY : '50vh',
              scrollCollapse : true,
              "processing" : true,
              "serverSide" : true,
              "order" : [],
              "ajax" : {
                 url:"tabel/person/server-side.php",
                 type:"POST",
                 data:{is_sort:is_sort, nipegup:nipegup,pValue:pValue, kValue:kValue, kdunit:kdunit}
              },

              fixedColumns: {
                 heightMatch : "none",
                 leftColumns: 4
              },
              dom : "Bfrtip",
              lengthMenu: [
                 [ 10, 50, 100, -1 ],
                 [ '10 rows', '50 rows', '100 rows', 'Show all' ]
              ],
              buttons : [
                 'pageLength',
                 {
                    extend: 'excel',
                    exportOptions: {
                       columns: [0,1,2,3,4,5,6,7,8,9,10,11,12]
                    },
                    action: newExportAction
                 },
                 {
                    extend: 'csv',
                    exportOptions: {
                       columns: [0,1,2,3,4,5,6,7,8,9,10,11,12]
                    },
                    action: newExportAction
                 },
                 {
                    extend: 'print',
                    exportOptions: {
                       columns: [0,1,2,3,4,5,6,7,8,9,10,11,12]
                    },
                    action: newExportAction
                 }
              ]
           });
}

$('#view-sort').click(function(){
   var pValue = $('#pValue').val();
   var kValue = $('#kValue').val();
   var nipegup = $('#nipegup').val();
   var kdunit = $('#kdunit').val();
   if(pValue != ''  && kValue !='')
   {
      $('#tabel-main').DataTable().destroy();
      fetch_data('yes', nipegup,pValue, kValue,kdunit);
   } else {
      alert("error");
   }
})

function update_data(id, column_name, value) {
   $.ajax({
      url:"tabel/person/update-tabel-PK.php",
      method:"POST",
      data:{id:id, column_name:column_name, value:value},
      success:function(data)
      {
        $('#tabel-main').DataTable().fnDraw();
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

$(document).on('change', '#nipegup', function() {
   var nipegDtl = $('#nipegup').val();
   $.ajax({
      url:"models/getNamaBos.php",
      method: "get",
      data: {'foo':nipegDtl},
      success:function(msg) {
         $('#nipegup-dtl').val(msg);
      }
   })
})

$(document).on('change', '#kdunit', function() {
   var kdunitDtl = $('#kdunit').val();
   $.ajax({
      url:"models/getNamaUnit.php",
      method: "get",
      data: {'foo':kdunitDtl},
      success:function(msg) {
         $('#kdunit-dtl').val(msg);
      }
   })
})

});
</script>
