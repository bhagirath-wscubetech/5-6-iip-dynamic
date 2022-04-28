<?php
include "app/database.php";
include "app/helper.php";

$data = $_POST;
$response = [];
if ($data['password'] == $data['repeat_password']) {
    // next step
    $password = md5($data['password']);
    $email = $data['email'];
    $name = $data['name'];
    $user = getUser($email);
    if (count($user) > 0) {
        $response = [
            'status' => 0,
            'msg' => "User with this email already exists"
        ];
    } else {
        $response = [
            'status' => 1,
            'msg' => "No error"
        ];
        // $ins = "INSERT INTO users SET name = '$name', email = '$email', password = '$password'";
        // p($ins);
        //     // try {
        //     //     $flag = mysqli_query($conn, $ins);
        //     // } catch (\Exception $err) {
        //     //     $flag = false;
        //     // }
        //     // if ($flag) {
        //     //     $response = [
        //     //         'status' => 1,
        //     //         'msg' => "Registration successful"
        //     //     ];
        //     // } else {
        //     //     $response = [
        //     //         'status' => 0,
        //     //         'msg' => "Internal server error, unable to registe"
        //     //     ];
        //     // }
    }
} else {
    $response = [
        'status' => 0,
        'msg' => "Password and confirm password must match"
    ];
}


echo json_encode($response);
