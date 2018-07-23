<?php
require_once("../db.php");
unset($_SESSION['user']);
echo "<script>window.location='login.php';</script>";
?>