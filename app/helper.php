<?php
// usefull functions 
session_start();
$baseUrl = "http://localhost/iip-dynamic/";
function p($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}


function generateResetToken()
{
    global $conn;
    $bytes = random_bytes(40);
    $token =  bin2hex($bytes);
    // $token = "12019d76849360de76a8ca5aa9aab37413197b97";
    $selTokenCount = mysqli_num_rows(mysqli_query(
        $conn,
        "SELECT id FROM reset_password WHERE token = '$token'"
    ));
    // p($selTokenCount);
    if ($selTokenCount == 1) {
        return generateResetToken();
    }
    return $token;
    // return $token;
}
