<?php
include '../../db.php';
$columns = array(
    'nip',
    'nama',
    'kdunit',
    'idjob',
    'util',
    'kdunit_next',
    'idjob_next',
    'nip'
);
$query = 'SELECT p1.NIPEG nip, p1.NAMA nama,p1.KDKRJ kdunit, p1.IDJOB idjob, p1.util util, p1.KDKRJ_NEXT kdunit_next, p1.NIPEG nip, p1.IDJOB_NEXT idjob_next, p1.NIPEG nip  FROM person p1 LEFT JOIN kdtkerj k ON p1.KDKRJ = k.KDKRJ LEFT JOIN jobtitle j ON p1.IDJOB = j.IDJOB WHERE p1.P_NILAI="1" AND p1.K_NILAI="1" ';

if(isset($_POST["search"]["value"]))
{
 $query .= ' AND (p1.NIPEG LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR p1.NAMA LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR p1.P_NILAI LIKE "%'.$_POST["search"]["value"].'%") ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY p1.NAMA ASC ';
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
    $sub_array[] = $row["nip"];
    $sub_array[] = $row["nama"];
    $sub_array[] = '<div><a href="#" class="hover" id="'.$row["kdunit"].'">' . $row["kdunit"] . '</a></div>';
    $sub_array[] = '<div><a href="#" class="hoverj" id="' . $row["idjob"]. '">' . $row["idjob"] . '</a></div>';
    $sub_array[] = '<center><p contenteditable style="color:rgb(157, 157, 157);"class="update" data-column="util" data-id="'.$row["nip"].'"> '.$row["util"].'</p></center>';
    $sub_array[] = '<center><div contenteditable style="color:rgb(157, 157, 157);"class="update hover" id="'.$row["kdunit_next"].'" data-id="'.$row["nip"].'" data-column="KDKRJ_NEXT"> '.$row["kdunit_next"].'</div></center>';
    $sub_array[] = '<center><div contenteditable style="color:rgb(157, 157, 157);"class="update hoverj" id="'.$row["idjob_next"].'" data-column="IDJOB_NEXT" data-id="'.$row["nip"].'"> '.$row["idjob_next"].'</div></center>';
    $sub_array[] = '<center><div class="btn btn-xs btn-warning" id="submit-data" data-fm="'.$row["util"].'" data-unit="'.$row["kdunit_next"].'" data-job="'.$row["idjob_next"].'" data-id="'.$row["nip"].'">submit</div></center>';
    $data[]      = $sub_array;
}

function get_all_data($conn)
{
	$query = "SELECT * FROM person WHERE P_NILAI=1 AND K_NILAI = 1";
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
