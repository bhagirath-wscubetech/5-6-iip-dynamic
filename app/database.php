<?php
    // connection establish
    error_reporting(0);
    try{
        $conn = mysqli_connect("localhost","root","","iip");
    }
    catch(\Exception $err){
        die("Connection error");
    }
?>