<?php
include '../../db.php';
$columns = array(
    'IDJOB',
    'JOBTITLE',
    'keyC'
);
$query = "SELECT IDJOB, JOBTITLE, keyC FROM jobtitle ";

if(isset($_POST["search"]["value"]))
{
 $query .= 'WHERE IDJOB LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR (JOBTITLE LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR keyC LIKE "%'.$_POST["search"]["value"].'%") ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY JOBTITLE ASC ';
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
    $sub_array[] = $row["IDJOB"];
    $sub_array[] = $row["JOBTITLE"];
    $sub_array[] = '<center><div contenteditable style="background-color:rgb(255, 255, 255); color:rgb(157, 157, 157);" class="update" data-id="' . $row["IDJOB"] . '" data-column="keyC">' . $row["keyC"] . '</div></center>';
    $data[]      = $sub_array;
}

function get_all_data($conn)
{
	$query = "SELECT * FROM jobtitle";
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
