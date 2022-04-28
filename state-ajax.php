<?php
include "app/database.php";
include "app/helper.php";

$cId = $_GET['cId'];

$sel = "SELECT * FROM states WHERE country_id = $cId";
$exe = mysqli_query($conn, $sel);
$data = mysqli_fetch_all($exe);

$opt = "<option> Select a state </option>";

foreach ($data as $state) {
    $opt .= "<option>" . $state[1] . "</option>";
}
echo $opt;
