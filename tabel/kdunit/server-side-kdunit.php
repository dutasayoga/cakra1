<?php
include '../../db.php';
$columns = array(
    'KDKRJ',
    'DIREKT',
	 'DIVISI',
	 'BAGIAN',
	 'URUSAN',
    'keyU'
);
$query = "SELECT KDKRJ, DIREKT, DIVISI, BAGIAN, URUSAN, keyU FROM kdtkerj WHERE";

if($_POST["is_sort"] == "yes")
{
   if($_POST["kdunit"] == ""){
      $query .= '';
   } elseif ($_POST["kdunit"] != "") {
      $query .= ' DIVISI = "'.$_POST["kdunit"].'" AND ';
   }
}
if(isset($_POST["search"]["value"]))
{
 $query .= '  (KDKRJ LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR DIREKT LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR DIVISI LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR URUSAN LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR BAGIAN LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR keyU LIKE "%'.$_POST["search"]["value"].'%") ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY KDKRJ ASC ';
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
    $sub_array[] = $row["KDKRJ"];
    $sub_array[] = '<center><strong><div contenteditable style="color:rgb(157, 157, 157);" class="update" data-id="' . $row["KDKRJ"] . '" data-column="keyU">' . $row["keyU"] . '</div></strong></center>';
	 $sub_array[] = $row["DIREKT"];
	 $sub_array[] = $row["DIVISI"];
	 $sub_array[] = $row["BAGIAN"];
	 $sub_array[] = $row["URUSAN"];
    $data[]      = $sub_array;
}

function get_all_data($conn)
{
	$query = "SELECT KDKRJ, DIREKT, DIVISI, BAGIAN, URUSAN, keyU FROM kdtkerj";
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
