<?php
// $name = $_GET['name'];
// echo "Hey $name, welcome to WsCube Tech!!";
function p($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

$response = [
    'status' => 1,
    'msg' => 'Successfully done'
];


echo json_encode($response);
