<?php
include "../app/helper.php";
unset($_SESSION['admin_id']);
unset($_SESSION['admin_name']);
header("LOCATION:login.php");
?>