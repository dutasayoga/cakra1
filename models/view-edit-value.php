<?php
require_once("../db.php");
if ($_POST['Pvalue'] == '0' && $_POST['Kvalue'] != '0') {
    $x = $_POST['Kvalue'];
    $Pvalue = array('0','1','2','3');
    $Kvalue = array($x,$x,$x,$x);
} elseif ($_POST['Kvalue'] == '0' && $_POST['Pvalue'] != '0') {
    $x = $_POST['Pvalue'];
    $Kvalue = array('0','1','2','3');
    $Pvalue = array($x,$x,$x,$x);
} else {
    $x = $_POST['Pvalue'];
    $y = $_POST['Kvalue'];
    $Kvalue = array($y,$y,$y,$y);
    $Pvalue = array($x,$x,$x,$x);
}

?>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CAKRA</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">    
    <link rel="icon" href="../assets/Images/home.png">
<style>
#tablevalue{
    font-size:13px;
    margin-top:10px;
}
</style>
</head>

<body>
    <center>
        <div>
            <div class="table-responsive">
                <table class="table table-bordered" id="tablevalue">
                    <thead id="th">
                        <tr>
                            <th>NIPEG</th>
                            <th>NAMA</th>
                            <th>TANGGAL LAHIR</th>
                            <th>TMTKERJA</th>
                            <th>E_MAIL</th>
                            <th>KODPEN</th>
                            <th>STSPEG</th>
                            <th>KDKRJ</th>
                            <th>IDJOB</th>
                            <th>NIPEG_UP</th>
                            <th>PANGKAT</th>
                            <th>P_NILAI</th>
                            <th>K_NILAI</th>
                            <th>STATUS_PK</th>
                            <th>PK_UPDATE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $ambil=$conn->query("SELECT * FROM person WHERE P_NILAI IN ('".$Pvalue[0]."','".$Pvalue[1]."','".$Pvalue[2]."','".$Pvalue[3]."') AND K_NILAI IN ('".$Kvalue[0]."','".$Kvalue[1]."','".$Kvalue[2]."','".$Kvalue[3]."') ") ?>
                        <?php while($break = $ambil->fetch_assoc()) { ?>
                        <tr>
                            <td>
                                <?php echo $break['NIPEG']; ?>
                            </td>
                            <td>
                                <?php echo $break['NAMA']; ?>
                            </td>
                            <td>
                                <?php echo $break['TGLLAHIR']; ?>&ensp;</td>
                                <td>
                                    <?php echo $break['TMTKERJA']; ?>
                                </td>
                                <td>
                                    <?php echo $break['E_MAIL']; ?>
                                </td>
                                <td>
                                    <?php echo $break['KODPEN']; ?>
                                </td>
                                <td align="center">
                                    <?php echo $break['STSPEG']; ?>
                                </td>
                                <td>
                                    <a>
                                        <?php echo $break['KDKRJ']; ?>
                                    </a>
                                </td>
                                <td>
                                    <a>
                                        <?php echo $break['IDJOB']; ?>
                                    </a>
                                </td>
                                <td>
                                    <?php echo $break['NIPEG_UP']; ?>
                                </td>
                                <td align="center">
                                    <?php echo $break['PANGKAT']; ?>
                                </td>
                                <td align="center">
                                    <?php echo $break['P_NILAI']; ?>
                                </td>
                                <td align="center">
                                    <?php echo $break['K_NILAI']; ?>
                                </td>
                                <td align="center">
                                    <?php echo $break['STATUS_PK']; ?>
                                </td>
                                <td>
                                    <?php echo $break['PK_UPDATE']; ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </center>

    </boody>

    </html>