<?php
// connection establish
// error_reporting(0);

try {
    $conn = mysqli_connect("localhost", "root", "", "iip");
} catch (\Exception $err) {
    die("Connection error");
}

function getIp()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
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


function getUser($email = "", $id = "")
{
    global $conn;
    $sel = "SELECT * FROM users WHERE email = '$email' OR id = $id";
    $exe = mysqli_query($conn, $sel);
    $data = mysqli_fetch_assoc($exe);
    return $data;
}


function lastLoginAdmin()
{
    global $conn;
    $ip = getIp();
    $id = $_SESSION['admin_id'];
    try {
        $ins = "INSERT INTO admin_logs SET admin_id = $id, time = current_timestamp(), ip = '$ip'";
        mysqli_query($conn, $ins);
        $upd = "UPDATE admins SET last_login = current_timestamp() WHERE id = $id";
        mysqli_query($conn, $upd);
    } catch (\Exception $err) {
        $flag = false;
        // p($err->getMessage());
        // die;
    }
}
