<?php
require_once("db.php");
if(!isset($_SESSION['user'])){
    echo "<script>window.location='login/login.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>CAKRA</title>
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/css/sb-admin.css">
      <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="assets/DataTables/DataTables-1.10.18/css/jquery.dataTables.css"/>
      <link rel="stylesheet" type="text/css" href="assets/DataTables/Buttons-1.5.2/css/buttons.dataTables.min.css"/>
      <link rel="stylesheet" type="text/css" href="assets/DataTables/FixedColumns-3.2.5/css/fixedColumns.dataTables.min.css"/>
      <link rel="stylesheet" type="text/css" href="assets/DataTables/Scroller-1.5.0/css/scroller.dataTables.min.css"/>

      <link rel="icon" href="assets/Images/home.png">
      <style>
        #modal-qty{
            top:5%;
            left : 70%;
        }

      </style>
   </head>
   <body>
      <div class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="navbar">
         <ul class="nav navbar-nav">
            <li><a href="index.php"> Form Person</a></li>
            <li><a href="index.php?halaman=kdunit">Form Unit</a></li>
            <li><a href="index.php?halaman=jobtitle">Form Job</a></li>
            <li><a href="index.php?halaman=toptalent">Form Top Talent</a></li>
         </ul>
         <ul style="margin-right:10px;"class="nav navbar-nav navbar-right">
            <li><button class="btn btn-danger navbar-btn" data-toggle="modal" data-target="#modal-qty">Graph</button></li>
            <li><a href="login/logout.php" name="logout"><i class="fa fa-power-off"></i> logout</a></li>
         </ul>
      </div>

      <div style="margin-top:10px;" class="col-md-12" id="body-wrapper">
         <div class="table-responsive">
            <?php
            if (isset($_GET['halaman'])) {
               {
                  if ($_GET['halaman']=="toptalent") {
                     include 'tabel/toptalent/tabel-top-talent.php';
                  } elseif ($_GET['halaman']=="kdunit") {
                     include 'tabel/kdunit/tabel-kdunit.php';
                  } elseif ($_GET['halaman']=="jobtitle") {
                     include 'tabel/jobtitle/tabel-jobtitle.php';
                  }
               }
            } else {
               include 'tabel/person/tabel-data.php';
            }

            ?>
         </div>
         <div id="modal-qty" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
               <div class="modal-content">
                  <form class="form-horizontal">
                     <div class="modal-body">
                     <button type="button" data-dismiss="modal" class="close">&times;</button>
                     <?php include 'models/qty.php'; ?>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div id="view-box" class="modal fade" data-backdrop="static" role="dialog">
            <div class="modal-dialog modal-lg">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">x</button>
                     <h2 align="center" class="modal-title">DETAIL PEGAWAI </h2>
                  </div>
                  <form class="form-horizontal" enctype="multipart/form-data" id="form">
                     <div class="modal-body" id="employee_detail">
                     </div>
                  </form>
               </div>
            </div>
         </div>

      </div>
      <script type="text/javascript" src="assets/DataTables/jQuery-3.3.1/jquery-3.3.1.min.js"></script>
      <script type="text/javascript" src="assets/js/bootstrap.js"></script>
      <script type="text/javascript" src="assets/js/bootstrap3-typeahead.min.js"></script>
      <script type="text/javascript">
      $(document).ready(function(){
         $(document).on('click', '.view-data', function() {
            var employee_id = $(this).attr("id");
            if(employee_id != '')
            {
                $.ajax({
                      url:"models/view-data.php",
                      method:"POST",
                      data:{employee_id:employee_id},
                      success:function(data){
                          $('#employee_detail').html(data);
                          $('#view-box').modal('show');
                      }
                });
            }
         });

      });
      </script>
      <script type="text/javascript" src="assets/DataTables/JSZip-2.5.0/jszip.min.js"></script>
      <script type="text/javascript" src="assets/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
      <script type="text/javascript" src="assets/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
      <script type="text/javascript" src="assets/DataTables/DataTables-1.10.18/js/jquery.datatables.min.js"></script>
      <script type="text/javascript" src="assets/DataTables/Buttons-1.5.2/js/dataTables.buttons.min.js"></script>
      <script type="text/javascript" src="assets/DataTables/Buttons-1.5.2/js/buttons.html5.min.js"></script>
      <script type="text/javascript" src="assets/DataTables/Buttons-1.5.2/js/buttons.print.min.js"></script>
      <script type="text/javascript" src="assets/DataTables/fixedColumns-3.2.5/js/dataTables.fixedColumns.min.js"></script>
      <script type="text/javascript" src="assets/DataTables/Scroller-1.5.0/js/dataTables.scroller.min.js"></script>
   </body>

</html>
