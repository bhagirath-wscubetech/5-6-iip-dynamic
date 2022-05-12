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
    $user = getUser($email) ?? [];
    if (count($user) > 0) {
        $response = [
            'status' => 0,
            'msg' => "User with this email already exists"
        ];
    } else {
        $ins = "INSERT INTO users SET name = '$name', email = '$email', password = '$password'";
        try {
            $flag = mysqli_query($conn, $ins);
        } catch (\Exception $err) {
            $flag = false;
        }
        if ($flag) {
            $_SESSION['global_msg'] = "Registration Successfully, Please login Once!";
            $_SESSION['global_status'] = 1;
            $response = [
                'status' => 1
            ];
        } else {
            $response = [
                'status' => 0,
                'msg' => "Internal server error, unable to registe"
            ];
        }
    }
} else {
    $response = [
        'status' => 0,
        'msg' => "Password and confirm password must match"
    ];
}


echo json_encode($response);
