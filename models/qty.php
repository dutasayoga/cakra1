<?php
$ambil = $conn->query("SELECT COUNT(NAMA) FROM person WHERE P_NILAI = 1 AND K_NILAI = 1");
$ambil1 = $conn->query("SELECT COUNT(NAMA) FROM person WHERE P_NILAI = 1 AND K_NILAI = 2");
$ambil2 = $conn->query("SELECT COUNT(NAMA) FROM person WHERE P_NILAI = 1 AND K_NILAI = 3");
$ambil3 = $conn->query("SELECT COUNT(NAMA) FROM person WHERE P_NILAI = 2 AND K_NILAI = 1");
$ambil4 = $conn->query("SELECT COUNT(NAMA) FROM person WHERE P_NILAI = 2 AND K_NILAI = 2");
$ambil5 = $conn->query("SELECT COUNT(NAMA) FROM person WHERE P_NILAI = 2 AND K_NILAI = 3");
$ambil6 = $conn->query("SELECT COUNT(NAMA) FROM person WHERE P_NILAI = 3 AND K_NILAI = 1");
$ambil7 = $conn->query("SELECT COUNT(NAMA) FROM person WHERE P_NILAI = 3 AND K_NILAI = 2");
$ambil8 = $conn->query("SELECT COUNT(NAMA) FROM person WHERE P_NILAI = 3 AND K_NILAI = 3");
$row = $ambil->fetch_assoc();
$row1 = $ambil1->fetch_assoc();
$row2 = $ambil2->fetch_assoc();
$row3 = $ambil3->fetch_assoc();
$row4 = $ambil4->fetch_assoc();
$row5 = $ambil5->fetch_assoc();
$row6 = $ambil6->fetch_assoc();
$row7 = $ambil7->fetch_assoc();
$row8 = $ambil8->fetch_assoc();

?>
<style>
.grid-container {
  display: grid;
  grid-template-columns: auto auto auto auto;
  background-color: white;
  padding: 10px;
}
.grid-item {

  background-color: white;
  padding: 20px;
  font-size: 15px;
  text-align: center;
}

.g1,.g2,.g3,.g4,.g5,.g6,.g7,.g8,.g9 {
    border: 1px solid black;
    box-shadow: 1px 1px;
    margin: 2px;
    border-radius: 5px;
}

.g1, .g9{
    background-color: #079B76;
}
.g4, .g8{
    background-color: #5AD5B6;
}
.g2, .g5, .g6{
    background-color: #D97E7E;
}
.g3 {
    background-color: #F4152F;
}
</style>
<div class="grid-container">
  <div class="grid-item">P1</div>
  <div class="grid-item g1"><?php echo implode("",$row2); ?></div>
  <div class="grid-item g2"><?php echo implode("",$row1); ?></div>
 <a href="index.php?halaman=toptalent"><div class="grid-item g3"><?php echo implode("",$row); ?></div></a>
  <div class="grid-item">P2</div>
  <div class="grid-item g4"><?php echo implode("",$row5); ?></div>
  <div class="grid-item g5"><?php echo implode("",$row4); ?></div>
  <div class="grid-item g6"><?php echo implode("",$row3); ?></div>
  <div class="grid-item">P3</div>
  <div class="grid-item g7"><?php echo implode("",$row8); ?></div>
  <div class="grid-item g8"><?php echo implode("",$row7); ?></div>
  <div class="grid-item g9"><?php echo implode("",$row6); ?></div>
  <div class="grid-item"></div>
  <div class="grid-item">K3</div>
  <div class="grid-item">K2</div>
  <div class="grid-item">K1</div>
</div>

<center><p>P: Performance &emsp; K: Competencies</p></center>

<table class="table table-responsive table-bordered">
    <thead>
        <tr>
            <th>Ket</td>
            <th>jumlah</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>P=1 K=1</td>
            <td><?php echo implode("",$row); ?></td>
        </tr>
        <tr>
            <td>P=1 K=2</td>
            <td><?php echo implode("",$row1); ?></td>
        </tr>
        <tr>
            <td>P=1 K=3</td>
            <td><?php echo implode("",$row2); ?></td>
        </tr>
        <tr>
            <td>P=2 K=1</td>
            <td><?php echo implode("",$row3); ?></td>
        </tr>
        <tr>
            <td>P=2 K=2</td>
            <td><?php echo implode("",$row4); ?></td>
        </tr>
        <tr>
            <td>P=2 K=3</td>
            <td><?php echo implode("",$row5); ?></td>
        </tr>
        <tr>
            <td>P=3 K=1</td>
            <td><?php echo implode("",$row6); ?></td>
        </tr>
        <tr>
            <td>P=3 K=2</td>
            <td><?php echo implode("",$row7); ?></td>
        </tr>
        <tr>
            <td>P=3 K=3</td>
            <td><?php echo implode("",$row8); ?></td>
        </tr>
    </tbody>
</table>
