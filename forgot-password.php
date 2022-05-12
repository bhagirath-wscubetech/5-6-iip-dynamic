<?php
include "app/database.php";
include "app/helper.php";
if (isset($_POST['send'])) {

    $email = $_POST['email'];
    $sel = "SELECT * FROM users WHERE email = '$email'";
    $exe = mysqli_query($conn, $sel);
    $user = mysqli_fetch_assoc($exe);
    if (isset($user['id'])) {
        // email sahi hai
        $userId = $user['id'];
        $token = generateResetToken();
        $resetPassword = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM reset_password WHERE user_id = $userId"));
        if (isset($resetPassword['token'])) {
            $ins = "UPDATE reset_password SET token = '$token' WHERE user_id = $userId";
            $flag = mysqli_query($conn, $ins);
        } else {
            $ins = "INSERT INTO reset_password SET user_id = $userId, token = '$token'";
            $flag = mysqli_query($conn, $ins);
        }
        $url = $baseUrl . "reset-password.php?token=$token";
        p($url);
    } else {
        $_SESSION['global_msg'] = "Invalid email";
        $_SESSION['global_status'] = 0;
    }
}
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style>
    .form-gap {
        padding-top: 70px;
    }
</style>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<div class="form-gap"></div>
<div class="form-gap"></div>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                        <h3><i class="fa fa-lock fa-4x"></i></h3>
                        <h2 class="text-center">Forgot Password?</h2>

                        <?php
                        include "layouts/global_msg.php";
                        ?>
                        <p>You can reset your password here.</p>
                        <div class="panel-body">

                            <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                        <input id="email" name="email" placeholder="email address" class="form-control" type="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-lg btn-primary btn-block" name="send" value="Reset Password" type="submit">
                                </div>
                                <input type="hidden" class="hide" name="token" id="token" value="">
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>