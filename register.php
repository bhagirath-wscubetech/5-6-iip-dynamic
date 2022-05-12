<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <style>
        .divider-text {
            position: relative;
            text-align: center;
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .divider-text span {
            padding: 7px;
            font-size: 12px;
            position: relative;
            z-index: 2;
        }

        .divider-text:after {
            content: "";
            position: absolute;
            width: 100%;
            border-bottom: 1px solid #ddd;
            top: 55%;
            left: 0;
            z-index: 1;
        }

        .btn-facebook {
            background-color: #405D9D;
            color: #fff;
        }

        .btn-twitter {
            background-color: #42AEEC;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="card bg-light">
        <article class="card-body mx-auto" style="min-width: 600px;">
            <h4 class="card-title mt-3 text-center">Create Account</h4>
            <div class="alert alert-primary" style="display: none;" id="response" role="alert">
            </div>
            <form id="registration_form">
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                    </div>
                    <input class="form-control" name="name" placeholder="Full name" type="text">
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                    </div>
                    <input name="email" class="form-control" placeholder="Email address" type="email">
                </div> <!-- form-group// -->

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input class="form-control" placeholder="Create password" name="password" type="password">
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input class="form-control" name="repeat_password" placeholder="Repeat password" type="password">
                </div> <!-- form-group// -->
                <div class="form-group">
                    <button id="submut_btn" type="submit" class="btn btn-primary btn-block"> Create Account </button>
                </div> <!-- form-group// -->
                <p class="text-center">Have an account? <a href="">Log In</a> </p>
            </form>
        </article>
    </div> <!-- card.// -->

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
        $("#registration_form").submit(
            function() {
                var form = $(this)
                var formData = form.serialize()
                $.ajax({
                    url: "register-ajax.php",
                    type: "post",
                    data: formData,
                    beforeSend: function() {
                        $("#response").hide()
                        $("#submut_btn")
                            .text("Processing...").attr("disabled", false)
                    },
                    success: function(response) {
                        var jsonRes = JSON.parse(response)
                        if (jsonRes.status == 1) {
                            window.location.href = "login.php";
                        } else {
                            // some error
                            $("#response").addClass("alert-warning").removeClass("alert-success")
                        }
                        $("#response").slideDown(1000, () => {
                            $("#response").html(jsonRes.msg)
                        })
                        $("#submut_btn")
                            .text("Create Account").attr("disabled", false)
                    }
                })
                return false;
            }
        )
    </script>
</body>

</html>