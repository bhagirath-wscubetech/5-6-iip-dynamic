<?php
// connection establish
error_reporting(0);
try {
    $conn = mysqli_connect("localhost", "root", "", "iip");
} catch (\Exception $err) {
    die("Connection error");
}

function toggleStatus($id, $tableName)
{
    global $conn;
    $selData = "SELECT status FROM $tableName WHERE id = $id";
    $exe =  mysqli_query($conn, $selData);
    $data = mysqli_fetch_assoc($exe);
    if ($data['status'] == "1") {
        $upd = "UPDATE  $tableName SET status = 0 WHERE id = $id";
    } else {
        $upd = "UPDATE  $tableName SET status = 1 WHERE id = $id";
    }
    try {
        $flag = mysqli_query($conn, $upd);
    } catch (\Exception $err) {
        echo $err->getMessage();
    }
}


function getCountries()
{
    global $conn;
    $sel = "SELECT * FROM countries WHERE status = 1";
    $exe = mysqli_query($conn, $sel);
    $data = mysqli_fetch_all($exe);
    return $data;
}


function getUser($email)
{
    global $conn;
    $sel = "SELECT * FROM users WHERE email = '$email'";
    $exe = mysqli_query($conn, $sel);
    $data = mysqli_fetch_assoc($exe);
    return $data;
}
