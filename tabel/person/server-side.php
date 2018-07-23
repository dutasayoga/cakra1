<?php
$conn = mysqli_connect("localhost", "root", "root", "cakra1");
$columns = array(
    'nip',
    'namapeg',
	 'pValue',
	 'kValue',
	 'namabos',
	 'direkt',
	 'divisi',
	 'bagian',
	 'urusan',
	 'jobttl',
	 'email',
	 'status',
	 'tglUpdate'
);
if($_POST["is_sort"]) {
   if($_POST['nipegup'] == ""){
      $value = "";
   }
   elseif($_POST["nipegup"] != ""){
      $value = $_POST["nipegup"];
   }
}

$query = "WITH RECURSIVE personCTE AS\n"
    . "(\n"
    . "     Select NIPEG , NAMA , NIPEG_UP ,KDKRJ, IDJOB, P_NILAI, K_NILAI, PK_UPDATE, E_MAIL,STATUS_PK\n"
    . "     From person\n"
    . "     WHERE NIPEG_UP = '".$value."' "
    . "    \n"
    . "     UNION ALL\n"
    . "    \n"
    . "     Select person.NIPEG , person.NAMA,\n"
    . "             person.NIPEG_UP, person.KDKRJ, person.IDJOB, person.P_NILAI, person.K_NILAI, person.PK_UPDATE, person.E_MAIL,person.STATUS_PK\n"
    . "     From person \n"
    . "     INNER JOIN personCTE \n"
    . "     ON person.NIPEG_UP = personCTE.NIPEG\n"
    . ")\n"
    . "\n"
    . "Select E1.NIPEG nip, E1.NAMA namapeg, E1.P_NILAI pValue, E1.K_NILAI kValue, E2.NAMA as namabos,k.DIREKT direkt, k.DIVISI divisi, k.BAGIAN bagian, k.URUSAN urusan, j.JOBTITLE jobttl, E1.E_MAIL email, E1.STATUS_PK status, E1.PK_UPDATE tglUpdate\n"
    . "From personCTE E1\n"
    . "LEFT Join personCTE E2\n"
    . "ON E1.NIPEG_UP = E2.NIPEG\n"
    . "LEFT JOIN kdtkerj k\n"
    . "ON E1.KDKRJ = k.KDKRJ\n"
    . "LEFT JOIN jobtitle j\n"
    . "on E1.IDJOB = j.IDJOB\n"
    . " WHERE ";

if($_POST["is_sort"] == "yes")
{
   if ($_POST['pValue'] == '0' && $_POST['kValue'] == '0') {
       $Pvalue = array('0','1','2','3');
       $Kvalue = array('0','1','2','3');
    }
   if ($_POST['pValue'] == '0' && $_POST['kValue'] != '0') {
       $x = $_POST['kValue'];
       $Pvalue = array('0','1','2','3');
       $Kvalue = array($x,$x,$x,$x);
   } if ($_POST['kValue'] == '0' && $_POST['pValue'] != '0') {
       $x = $_POST['pValue'];
       $Kvalue = array('0','1','2','3');
       $Pvalue = array($x,$x,$x,$x);
   } if ($_POST['kValue'] != '0' && $_POST['pValue'] != '0'){
       $x = $_POST['pValue'];
       $y = $_POST['kValue'];
       $Kvalue = array($y,$y,$y,$y);
       $Pvalue = array($x,$x,$x,$x);
   }

   $query .= ' E1.P_NILAI IN ("'.$Pvalue[0].'","'.$Pvalue[1].'","'.$Pvalue[2].'","'.$Pvalue[3].'") AND E1.K_NILAI IN ("'.$Kvalue[0].'","'.$Kvalue[1].'","'.$Kvalue[2].'","'.$Kvalue[3].'") AND  ';

   if($_POST['kdunit'] == "") {
      $query .= ' ';
   } elseif ($_POST['kdunit'] != "") {
      $query .= ' k.KDKRJ = "'.$_POST['kdunit'].'" AND ';
   }
}


if(isset($_POST["search"]["value"]))
{
 $query .= '(E1.NIPEG LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR E1.NAMA LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR E2.NAMA LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR k.DIVISI LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR j.JOBTITLE LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR k.URUSAN LIKE "%'.$_POST["search"]["value"].'%" ';

 $query .= 'OR E1.P_NILAI LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR E1.K_NILAI LIKE "%'.$_POST["search"]["value"].'%") ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY namapeg ASC ';
}

$query1 = '';

if($_POST["length"] != 1)
{
 $query1 .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($conn, $query));

$result = mysqli_query($conn, $query . $query1);

$data = array();

while ($row = mysqli_fetch_array($result)) {
    $sub_array   = array();
    $sub_array[] = '<div><a class="view-data" id="' . $row["nip"] . '">' . $row["nip"] . '</a></div>';
    $sub_array[] = '<div class="update" data-id="' . $row["nip"] . '" data-column="namapeg">' . $row["namapeg"] . '</div>';
	 $sub_array[] = '<center><div contenteditable style="color:rgb(157, 157, 157);" class="update" data-id="' . $row["nip"] . '" data-column="P_NILAI">' . $row["pValue"] . '</div></center>';
	 $sub_array[] = '<center><div contenteditable style="color:rgb(157, 157, 157);" class="update" data-id="' . $row["nip"] . '" data-column="K_NILAI">' . $row["kValue"] . '</div></center>';
	 $sub_array[] = '<div class="update" data-id="' . $row["nip"] . '" data-column="namabos">' . $row["namabos"] . '</div>';
	 $sub_array[] = '<div class="update" data-id="' . $row["nip"] . '" data-column="direkt">' . $row["direkt"] . '</div>';
	 $sub_array[] = $row["divisi"];
	 $sub_array[] = $row["bagian"];
	 $sub_array[] = $row["urusan"];
	 $sub_array[] = $row["jobttl"];
	 $sub_array[] = $row["email"];
	 $sub_array[] = $row["status"];
	 $sub_array[] = $row["tglUpdate"];
    $data[]      = $sub_array;
}

function get_all_data($conn)
{
	$query = "SELECT * FROM person";
   $result = mysqli_query($conn, $query);
   return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($conn),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>
