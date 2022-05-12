<?php
include "app/database.php";
include "app/helper.php";
$token = $_GET['token'];
$selTokenData = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT * FROM reset_password WHERE token = '$token'"
));
$userData = getUser("", $selTokenData['user_id']);
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
                                        <input id="email" name="email" placeholder="email address" class="form-control" readonly value="<?php echo $userData['email']; ?>" type="email">

                                    </div>
                                    <div class="form-group">
                                        <input id="email" name="email" placeholder="email address" class="form-control" type="email">
                                    </div>
                                    <div class="form-group">
                                        <input id="email" name="email" placeholder="email address" class="form-control" type="email">
                                    </div>
                                </div>
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