<?php
require_once('../db.php');
if(isset($_POST["employee_id"]))
{
   $output = '';
   $ambil=$conn->query("SELECT person.NIPEG, person.NAMA, person.E_MAIL, person.PANGKAT, person.P_NILAI, person.K_NILAI, kdtkerj.DIVISI, kdtkerj.BAGIAN, kdtkerj.URUSAN, jobtitle.JOBTITLE FROM person LEFT JOIN kdtkerj ON kdtkerj.KDKRJ = person.KDKRJ LEFT JOIN jobtitle ON jobtitle.IDJOB = person.IDJOB WHERE NIPEG = '".$_POST["employee_id"]."'");
   $output .= '
   <div class="table-responsive">
        <table class="table table-bordered">';
   while($row = $ambil->fetch_assoc())
   {
        $output .= '
             <tr>
                  <td width="30%"><label>NIP</label></td>
                  <td width="70%">'.$row["NIPEG"].'</td>
             </tr>
             <tr>
                  <td width="30%"><label>NAMA</label></td>
                  <td width="70%">'.$row["NAMA"].'</td>
             </tr>
             <tr>
                  <td width="30%"><label>E-mail</label></td>
                  <td width="70%">'.$row["E_MAIL"].'</td>
             </tr>
             <tr>
                  <td width="30%"><label>Pangkat</label></td>
                  <td width="70%">'.$row["PANGKAT"].'</td>
             </tr>
             <tr>
                  <td width="30%"><label>Nilai P</label></td>
                  <td width="70%">'.$row["P_NILAI"].' </td>
             </tr>
             <tr>
                  <td width="30%"><label>Nilai K</label></td>
                  <td width="70%">'.$row["K_NILAI"].' </td>
             </tr>
             <tr>
                  <td width="30%"><label>Divisi</label></td>
                  <td width="70%">'.$row["DIVISI"].' </td>
             </tr>
             <tr>
                  <td width="30%"><label>Bagian</label></td>
                  <td width="70%">'.$row["BAGIAN"].' </td>
             </tr>
             <tr>
                  <td width="30%"><label>URUSAN</label></td>
                  <td width="70%">'.$row["URUSAN"].' </td>
             </tr>
             <tr>
                  <td width="30%"><label>Jobtitle</label></td>
                  <td width="70%">'.$row["JOBTITLE"].' </td>
             </tr>
        ';
   }
   $output .= '
        </table>
   </div>
   ';
   echo $output;
}
?>
